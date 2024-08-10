<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Grupo;
use App\Contacto;
use App\WhatsAppBot;
use App\Sent;
use App\Sent_status;
use App\Sent_error;
use GuzzleHttp\Client;
use App\Colas;
use App\Totalmensajes;
use App\Config_wassap;
use App\Bolsa;
use Carbon\Carbon;

class ProcessWassapSent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public $timeout = 3600;

    public $i;
    public $cod_pais;
    public $numero;
    public $mensaje ;
    public $APIurl;
    public $token;
    public $id_contacto;
    public $etiqueta;
    public $key;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($i,$cod_pais,$numero,$mensaje,$APIurl,$token,$id_contacto,$etiqueta,$key)
    {
       $this->i = $i;
       $this->cod_pais = $cod_pais;
       $this->numero = $numero;
       $this->mensaje = $mensaje;
       $this->APIurl = $APIurl;
       $this->token = $token;
       $this->id_contacto = $id_contacto;
       $this->etiqueta = $etiqueta;
       $this->key = $key;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
      //  $API_CHAT_URL_BASE = env('API_CHAT_URL_BASE', '');
      //  $API_CHAT_TOKEN = env('API_CHAT_TOKEN', '');
      
        \Log ::info('new Cargando Data ... INICIO TEST ');
        // $instancia = Config_wassap::find(2); //temp
        \Log ::info('new Cargando Data ... CARGUE INSTANCIA ');
      
        $API_CHAT_URL_BASE = $this->APIurl;
        $API_CHAT_TOKEN = $this->token;
        $COLAS_MAX_EJECUCION = intval(env('COLAS_MAX_EJECUCION', '0'));
            
        $client = new Client(['base_uri' => $API_CHAT_URL_BASE]);
      //  $res = $client->request('GET', '/instance'.$instancia->INSTANCIA.'/showMessagesQueue?token='.$API_CHAT_TOKEN);
       

      //  $res = $client->request('GET', 'showMessagesQueue?token='.$API_CHAT_TOKEN);
      

      //   $data = json_decode($res->getBody());
      //   $totalMessages = intval($data->totalMessages);

        
        $totalMessages = 0; //faltaba punto y coma
        
        \Log ::info("new Cargando Data ...totalMessages ".$totalMessages );

        $model_total_mensajes = Totalmensajes::find($API_CHAT_TOKEN);
        
        if(isset($model_total_mensajes->TOTAL_MESSAGES)){
           
           $valor = $model_total_mensajes->TOTAL_MESSAGES;
        }
        else{
           $valor = 0;
        }
        
       
        if(intval($valor)<=$COLAS_MAX_EJECUCION){
           
           if(isset($model_total_mensajes->TOTAL_MESSAGES)){
           
              $model_total_mensajes->TOTAL_MESSAGES = $totalMessages ;
              $model_total_mensajes->save();
           
           }
           
                 \Log ::info('new Cargando Data ...Inicio ' );
                 
                  $now  = Carbon::now();
                  $month = Carbon::now()->month;
                  $year = Carbon::now()->year;
                  $cantidad_mensajes_por_mes = Bolsa::find($year.$month);
                  $mensajes_enviados = Sent::whereYear('created_at', '=', $year)
                  ->whereMonth('created_at', '=', $month)->count();
                 
                 $cantidad_mensajes_por_mes = Bolsa::find($year.$month);
                  
                  if (!$cantidad_mensajes_por_mes) {
                      
                      $identificador = $year.$month;
                      
                      $cantidad_mensajes_por_mes = new Bolsa;
                      $cantidad_mensajes_por_mes->cod_mes = $identificador;
                      $cantidad_mensajes_por_mes->max_mensajes = env('MSG_BAG','15000');
                      $cantidad_mensajes_por_mes->actual = $mensajes_enviados;
                      $cantidad_mensajes_por_mes->save();
                  }
                  
                  $actual = $cantidad_mensajes_por_mes->actual ;
                  
                 if($mensajes_enviados >= $cantidad_mensajes_por_mes->max_mensajes){
                    
                     \Log ::info('Limite de mensajes mensuales alcanzado' );
                     
                     if($this->i=='key_text'){
                        $type_msm="Texto";
                     }
                     else if($this->i=='key_img_'){
                        $type_msm="Imagen";
                     }
                     else if($this->i=='key_mov_'){
                        $type_msm="Video";
                     }
                     else if($this->i=='key_pdf_'){
                        $type_msm="PDF";
                     }
                     else if($this->i=='key_exce'){
                        $type_msm="Excel";
                     }
                     else if($this->i=='key_word'){
                        $type_msm="Word";
                     }
                     else if($this->i=='senttxti'){
                        $type_msm="Texto e Imagen";
                     }
                     else if($this->i=='senttxvi'){
                        $type_msm="Texto y video";
                     }
                     
                     
                     $Sent_error = Sent_error::create([
                        'ID_CONTACTO' => $this->id_contacto,
                        'BODY' => $this->mensaje,
                        'ETIQUETA' => $this->etiqueta,
                        'KEY' => $this->key,
                        'TYPE_MSM' => $type_msm,
                        'ERROR' => "Limite de mensajes alcanzado",
                     ]);

                 }
                 else {

                 
                    $WhatsAppBot = new WhatsAppBot();
                    $type_msm="";
                    $resultado = "";
                    if($this->i=='key_text'){
                                   $resultado = $WhatsAppBot->enviar_mensaje_regular($this->cod_pais, $this->numero ,$this->mensaje,$this->APIurl,$this->token);
                                   $type_msm="Texto";
                                   $enviados = 1;
                    }else if($this->i=='key_img_'){
                                   $resultado = $WhatsAppBot->enviar_imagen($this->cod_pais, $this->numero ,$this->mensaje,$this->APIurl,$this->token);
                                   $type_msm="Imagen";
                                   $enviados = 1;
                    }else if($this->i=='key_mov_'){
                                   $resultado = $WhatsAppBot->enviar_video($this->cod_pais, $this->numero ,$this->mensaje,$this->APIurl,$this->token);
                                   $type_msm="Video";
                                   $enviados = 1;
                    }else if($this->i=='key_pdf_'){
                                  $resultado = $WhatsAppBot->enviar_documento($this->cod_pais, $this->numero ,$this->mensaje,$this->APIurl,$this->token);
                                  $type_msm="PDF";
                                  $enviados = 1;
                    }else if($this->i=='key_exce'){
                                  $resultado = $WhatsAppBot->enviar_documento($this->cod_pais, $this->numero ,$this->mensaje,$this->APIurl,$this->token);
                                  $type_msm="Excel";
                                  $enviados = 1;
                    }else if($this->i=='key_word'){
                                  $resultado = $WhatsAppBot->enviar_documento($this->cod_pais, $this->numero ,$this->mensaje,$this->APIurl,$this->token);
                                  $type_msm="Word";
                                  $enviados = 1;
                    }else if($this->i=='senttxti'){
                                 $mensaje_temp = explode("((-))", $this->mensaje);
                                 $imagen_temp =$mensaje_temp[0];
                                 $texto_temp=$mensaje_temp[1];
                                 $resultado = $WhatsAppBot->enviar_imagen_y_texto($this->cod_pais, $this->numero ,$texto_temp, $imagen_temp,$this->APIurl,$this->token);
                                 $type_msm="Texto e Imagen";
                                 $enviados = 1;
                    }
                    else if($this->i=='senttxvi'){
                                 $mensaje_temp = explode("((-))", $this->mensaje);
                                 $video_temp =$mensaje_temp[0];
                                 $texto_temp=$mensaje_temp[1];
                                 $resultado = $WhatsAppBot->enviar_video_y_texto($this->cod_pais, $this->numero ,$texto_temp, $video_temp,$this->APIurl,$this->token);
                                 $type_msm="Texto y video";
                                 $enviados = 1;
                    }
                    
                    \Log ::info(print_r($resultado)); 
                    
                    if(isset($resultado['sent'])){ 
                        if($resultado['sent']){
                                      $id_envio = $resultado['id']."";
                                      $sent = Sent::create([
                                       'ID_ENVIO' => $id_envio,
                                       'ID_CONTACTO' => $this->id_contacto,
                                       'BODY' => $this->mensaje,
                                       'AUTHOR' => '0',
                                       'TIME' => '0',
                                       'CHATID' => '0',
                                       'TYPE' => '0',
                                       'SENDERNAME' => '0',
                                       'CAPTION' => '0',
                                       'QUOTEDMSGBODY' => '0',
                                       'QUOTEDMSGID' => '0',
                                       'CHATNAME' =>'0',
                                       'ETIQUETA' => $this->etiqueta,
                                       'KEY' => $this->key,
                                       'TYPE_MSM'=>$type_msm
                                      ]);
                                      
                                     $Sent_status= Sent_status::create([
                                       'ID_STATUS' => '0',
                                       'ID_ENVIO' => $id_envio,
                                       'SENT' => 'false',
                                       'DELIVERED' => 'false',
                                       'VIEWED' => 'false',
                                      ]);
                                    
                                      $cantidad_mensajes_por_mes = Bolsa::find($year.$month);
                                      $cantidad_mensajes_por_mes->actual = $actual + $enviados;
                                      $cantidad_mensajes_por_mes->save();
                        
                        }else{
                             $Sent_error = Sent_error::create([
                                       'ID_CONTACTO' => $this->id_contacto,
                                       'BODY' => $this->mensaje,
                                       'ETIQUETA' => $this->etiqueta,
                                       'KEY' => $this->key,
                                       'TYPE_MSM' => $type_msm,
                                       'ERROR' => $resultado['error'],
                             ]);
                       }
                    }else{
                        $error='Imposible de identificar';
                        if(isset($resultado['error'])){ $error=$resultado['error']; }
                        $Sent_error = Sent_error::create([
                                       'ID_CONTACTO' => $this->id_contacto,
                                       'BODY' => $this->mensaje,
                                       'ETIQUETA' => $this->etiqueta,
                                       'KEY' => $this->key,
                                       'TYPE_MSM' => $type_msm,
                                       'ERROR' => $error,
                        ]);
                    }
                    //\Log ::info(print_r($Sent_error,true));
                    \Log ::info('new Cargando Data ... Finalizo ');
                 
                 }
                 
        }else{
           
               $Colas = Colas::create([
                                    'I' => $this->i,
                                    'CODPAIS' => $this->cod_pais,
                                    'NUMERO' => $this->numero,
                                    'MENSAJE' => $this->mensaje,
                                    'APIURL' => $this->APIurl,
                                    'TOKEN' => $this->token,
                                    'ID_CONTACTO' => $this->id_contacto,
                                    'ETIQUETA' => $this->etiqueta,
                                    'KEY' => $this->key,
               ]);
            
        }
        


        //php artisan queue:restart
        //php artisan queue:table
        //php artisan migrate
        //php artisan queue:work --queue=high,default
        //nohup php artisan queue:work --daemon & 
        //https://stackoverflow.com/questions/28702780/setting-up-supervisord-on-a-aws-ami-linux-server
        //https://stackoverrun.com/es/q/7862070
        //php artisan queue:work --queue=high,default
    }
}
