<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Grupo;
use App\Contacto;
use App\WhatsAppBot;
use App\Sent;
use App\Sent_status;
use App\Sent_error;
use GuzzleHttp\Client;
use App\Colas;
use App\Totalmensajes;
use App\Jobs\ProcessWassapSent;
use App\Config_wassap;
use Carbon\Carbon;
use App\Bolsa;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            
            $month = Carbon::now()->month;
            $year = Carbon::now()->year;
            
            $identificador = $year.$month;
            
            \Log ::info('Creando mes '.$identificador );
            
            $bolsa = Bolsa::find($year.$month);
            
            if(!$bolsa){
                            
                $bolsa = new Bolsa();
                $bolsa->cod_mes = $identificador;
                $bolsa->max_mensajes = env('MSG_BAG','15000');
                $bolsa->actual = 0;
                
                $bolsa->save();
            }

        })->monthly();
        
        $schedule->call(function () {
            
            
            $instancias =  Config_wassap::get();
            
            foreach($instancias as $linea){
                $API_CHAT_URL_BASE = $linea->URL;
                $API_CHAT_TOKEN = $linea->API_KEY;
                $COLAS_ESPERA_HORAS = intval(env('COLAS_ESPERA_HORAS', '0'));
                $COLAS_MAX_EJECUCION = intval(env('COLAS_MAX_EJECUCION', '0'));
                $COLAS_MIN_ESPERA = intval(env('COLAS_MIN_ESPERA', '0'));
    
               
               try{
                
                // \Log ::info('new Schedule tarea inicio ' );
                $client = new Client(['base_uri' => $API_CHAT_URL_BASE ]);
                $res = $client->request('GET', 'showMessagesQueue?token='.$API_CHAT_TOKEN);
                $data = json_decode($res->getBody());
                $totalMessages = intval($data->totalMessages);
                // \Log ::info('Mensajes en cola:'.$totalMessages );
                
                $model_total_mensajes= Totalmensajes::where('TOKEN', $API_CHAT_TOKEN)->first();
                
                //cotrol colas
                $now  = Carbon::now();
                $date = Carbon::parse($model_total_mensajes->UPDATE_SQUEDULER);
                $diff = $date->diffInHours($now);
                
                
                if($totalMessages<=$COLAS_MIN_ESPERA){
                   $model_total_mensajes->TOTAL_MESSAGES = $totalMessages ; 
                }
               
                //VERIFICAMOS QUE LA COLA ENVIE AL JOB MAS TRABAJO 0>=150
                if($totalMessages<=$COLAS_MIN_ESPERA and $model_total_mensajes->TOTAL_MESSAGES<=$COLAS_MAX_EJECUCION ){
                    $model_total_mensajes->TOTAL_MESSAGES = $totalMessages ;
                    $Colas = Colas::orderBy('created_at', 'asc')->where("TOKEN",$API_CHAT_TOKEN)->take(200)->get();
                    
                    foreach ($Colas as $item) {
                         ProcessWassapSent::dispatch($item->I,$item->CODPAIS, $item->NUMERO ,$item->MENSAJE,$item->APIURL,$item->TOKEN,$item->ID_CONTACTO,$item->ETIQUETA,$item->KEY);
                         Colas::where('ID', $item->ID)->delete();
                    }
                }
                
                //reducir
                if($model_total_mensajes->TOTAL_MESSAGES<=$COLAS_MAX_EJECUCION){
                    $model_total_mensajes->TOTAL_MESSAGES = $totalMessages ;
                }   
                
                // \Log ::info('Actualizando: '.$model_total_mensajes->UPDATE_SQUEDULER );
                //VERIFICAMOS QUE LA COLA NO SE QUEDE PEGADA SE VERIFICA SI EL NUMERO CAMBIO Y CUANTO TIEMPO PASO DESDE EL ULTIMO CAMBIO
                //validamos que el total no haya cambiado en el rango de  2 horas //tiene que haber pasado 2 horas sin vcambiar
                if($model_total_mensajes->TOTAL_MESSAGES_SQUEDULER==$totalMessages){ //agregar diferencia horaria
                   
                   if($diff>=$COLAS_ESPERA_HORAS and $totalMessages!=0){
                        \Log ::info($API_CHAT_URL_BASE.'showMessagesQueue?token='.$API_CHAT_TOKEN);
                        $client = new Client(['base_uri' => $API_CHAT_URL_BASE ]);
                        $client->request('POST', 'clearMessagesQueue?token='.$API_CHAT_TOKEN);
                   }
                   
                }else{
                    $model_total_mensajes->TOTAL_MESSAGES_SQUEDULER = $totalMessages ;
                    $model_total_mensajes->UPDATE_SQUEDULER = $now ;
                    
                }   
                
                if($totalMessages==0){  
                    $model_total_mensajes->TOTAL_MESSAGES = $totalMessages ; 
                    $model_total_mensajes->UPDATE_SQUEDULER = $now ;
                }   
                
                $model_total_mensajes->save();
                //$date = Carbon::parse('2016-09-17 11:00:00');
               }catch(\Exception $e){
                  \Log ::info('Error al tratar de obtener cola, no se esta actualizando. Verifique la validez de la instancia' );
               }
            }
            
        })->cron('*/2 * * * *');
        
        //deberia reiniciar el worker sin problemas
        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
