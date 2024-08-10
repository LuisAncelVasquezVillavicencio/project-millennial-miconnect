<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mensajes_pruebas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
use View;
use Carbon\Carbon;
use App\WhatsAppBot;
use App\Sent_status;
use App\Sent;
use App\Recive;
use App\Config_wassap;
use Illuminate\Support\Facades\Log;


class whatsController extends Controller
{
    //
   public function Chat_Response(Request $request){
       //https://eu47.chat-api.com/instance139591/
       //5qzsfqhpihfr8rze
       
       $x = $request->all();
       $b = json_encode($x);
       
      
       //Log::info(  $b );
      /* $Instanceid = $request->get("instanceId");
       $idMensaje = "";
       $mio = "";*/
       
        
       
       /*Obteniendo estado de instancias por webhook
       * Jesus Salgado
       * 23/12/2020
       */
       /*if($request->has('status')){
          file_put_contents("status.log",print_r( json_decode($b ,true),true), FILE_APPEND );
          if($request->get('status') == $request->get('previous_status')){
             return "Sin cambios en el estado";
          }
          
          else{
             
              $instancia = Config_wassap::select('ID_WASSAP')->where("INSTANCIA",$request->get("instanceId"))->get();
             
              if($request->get('previous_status') == "loading"){
                   
                   foreach($instancia as $linea){
                      
                      $i = Config_wassap::find($linea->ID_WASSAP);
                      $i->estado = $request->get('status');
                      $i->save();
                   }
                  
                 
              }
              else if($request->get('status') == "loading"){
                 
                 foreach($instancia as $linea){
                      
                    if($request->get('previous_status') == "got qr code"){
                        $i = Config_wassap::find($linea->ID_WASSAP);
                        $i->estado = "authenticated";
                        $i->save();
                    }
                    else{
                        $i = Config_wassap::find($linea->ID_WASSAP);
                        $i->estado = "got qr code";
                        $i->save();
                    }
                  }
                 
              }
              else{
                 return "sin cambio";
              }
            
            return "sin cambios";
          }
       }*/
       
       


       
       /*
       * Luis Ancel Vasquez Villacicencio
       * 24/06/2020
       * Captura y Actualizacion de mensaje enviados
       */
       /*if ($request->has('messages')) {
          
          $message_encore = json_encode($request->get("messages"));
          $message_item = json_decode($message_encore);

          //actualizar datos de mensaje enviado (falta filtrar por los enviados por mi frome= 1)
          //file_put_contents("nuevo.log","envie_mensaje", FILE_APPEND );
          if ($message_item[0]->fromMe=='1') { 
             file_put_contents("sent.log",print_r( json_decode($b ,true),true), FILE_APPEND );
             $Sent = DB::table('tb_sent')
                       ->where('ID_ENVIO',$message_item[0]->id )
                       ->update(array('AUTHOR' => $message_item[0]->author,
                                      'TIME' => $message_item[0]->time,
                                      'CHATID' => $message_item[0]->chatId,
                                      'TYPE' => $message_item[0]->type,
                                      'SENDERNAME' => $message_item[0]->senderName,
                                      'CAPTION' => (isset($message_item[0]->caption) ? $message_item[0]->caption : null),
                                      'QUOTEDMSGBODY' => (isset($message_item[0]->quotedMsgBody) ? $message_item[0]->quotedMsgBody : null),
                                      'QUOTEDMSGID' => (isset($message_item[0]->quotedMsgId) ? $message_item[0]->quotedMsgId  : null),
                                      'CHATNAME' => (isset($message_item[0]->chatName) ? $message_item[0]->chatName : null)
                          ));
          }
       }*/

       if ($request->has('messages')) {
          
          $message_encore = json_encode($request->get("messages"));
          $message_item = json_decode($message_encore);
          //actualizar datos de mensaje enviado (falta filtrar por los enviados por mi frome= 1)
          //file_put_contents("nuevo.log","envie_mensaje", FILE_APPEND );
          if ($message_item[0]->fromMe==true) { //(mensaje enviado por sistema actualizacion)
             //file_put_contents("sent.log",print_r( json_decode($b ,true),true), FILE_APPEND );
             $Sent = DB::table('tb_sent')
                       ->where('ID_ENVIO',$message_item[0]->id )
                       ->update(array('AUTHOR' => $message_item[0]->author,
                                      'TIME' => $message_item[0]->time,
                                      'CHATID' => $message_item[0]->chatId,
                                      'TYPE' => $message_item[0]->type,
                                      'SENDERNAME' => $message_item[0]->senderName,
                                      'CAPTION' => (isset($message_item[0]->caption) ? $message_item[0]->caption : null),
                                      'QUOTEDMSGID' => (isset($message_item[0]->quotedMsgId) ? $message_item[0]->quotedMsgId  : null),
                                      'CHATNAME' => (isset($message_item[0]->chatName) ? $message_item[0]->chatName : null)
                          ));
          }
       }

       
     //  return "ok"; /* Detener registro en base */
       /*
       * Luis Ancel Vasquez Villacicencio
       * 24/06/2020
       * Captura y Actualizacion de status
       */
       /*if ($request->has('ack')) {
          file_put_contents("ack.log",print_r( json_decode($b ,true),true), FILE_APPEND );
          $message_encore = json_encode($request->get("ack"));
          $message_item = json_decode($message_encore);
          //actualizar datos de mensaje enviado (falta filtrar por los enviados por mi frome= 1)
          if($message_item[0]->status=='sent'){ 
             $Sent = DB::table('tb_sent_status')
                    ->where('ID_ENVIO',$message_item[0]->id )
                    ->update(array('SENT' => 'true' ));
          }elseif($message_item[0]->status=='delivered'){ 
             $Sent = DB::table('tb_sent_status')
                    ->where('ID_ENVIO',$message_item[0]->id )
                    ->update(array('DELIVERED' => 'true' ));
          }elseif($message_item[0]->status=='viewed'){
             $Sent = DB::table('tb_sent_status')
                    ->where('ID_ENVIO',$message_item[0]->id )
                    ->update(array('VIEWED' => 'true' ));
          }
       }*/

       if ($request->has('ack')) {
          //file_put_contents("ack.log",print_r( json_decode($b ,true),true), FILE_APPEND );
          $message_encore = json_encode($request->get("ack"));
          $message_item = json_decode($message_encore);
          //actualizar datos de mensaje enviado (falta filtrar por los enviados por mi frome= 1)

          //Log::info(  json_encode($message_item) );

          if($message_item[0]->status=='sent'){ 
             $Sent = DB::table('tb_sent_status')
                    ->where('ID_ENVIO',$message_item[0]->id )
                    ->update(array('SENT' => 'true' ));
          }elseif($message_item[0]->status=='delivered'){ 
             $Sent = DB::table('tb_sent_status')
                    ->where('ID_ENVIO',$message_item[0]->id )
                    ->update(array('DELIVERED' => 'true' ));
          }elseif($message_item[0]->status=='viewed'){
             $Sent = DB::table('tb_sent_status')
                    ->where('ID_ENVIO',$message_item[0]->id )
                    ->update(array('VIEWED' => 'true' ));
          }elseif($message_item[0]->status=='read'){
             $Sent = DB::table('tb_sent_status')
                    ->where('ID_ENVIO',$message_item[0]->id )
                    ->update(array('VIEWED' => 'true' ));
          }
       }




       /*
               {"messages":[
          {"id":"ABGGUZQWlRMfAhC-yx7uJ-Tbcv4RAgIe8j6o",
          "body":"Gsksgg",
          "fromMe":false,
          "self":0,
          "isForwarded":false,
          "author":"51941695131@c.us",
          "time":"1655853597",
          "chatId":"51941695131@c.us",
          "type":"chat",
          "senderName":"Luis Ancel",
          "caption":null,
          "quotedMsgId":null,
          "chatName":"51941695131"
        }],"instanceId":147561}
        */
        /*
       * Luis Ancel Vasquez Villacicencio
       * 24/06/2020
       * Captura y Actualizacion de mensaje recibidos
       */
       if ($request->has('messages')) {
          $message_encore = json_encode($request->get("messages"));
          $message_item = json_decode($message_encore);
          //almacenar datos recibidos de usuarios wassap
          $contacto='0';
          $etiqueta = 'No se encontro ninguna etiqueta';

          if ($message_item[0]->fromMe==false) { 
             //file_put_contents("received.log",print_r( json_decode($b ,true),true), FILE_APPEND );
             $id_contacto = Sent::select('ID_CONTACTO','ETIQUETA')->where('CHATID', $message_item[0]->chatId )->orderBy('created_at', 'desc')->first() ; //
             if(isset($id_contacto->ID_CONTACTO)){
                 $contacto = $id_contacto->ID_CONTACTO;
                 $etiqueta = $id_contacto->ETIQUETA;
             }
             $Recive = Recive::create([
                             'ID_RECIVE' => $message_item[0]->id,
                             'ID_CONTACTO' =>  $contacto,
                             'BODY' => $message_item[0]->body,
                             'AUTHOR' => $message_item[0]->author,
                             'TIME' => $message_item[0]->time,
                             'CHATID' =>$message_item[0]->chatId,
                             'TYPE' => $message_item[0]->type,
                             'SENDERNAME' => $message_item[0]->senderName,
                             'CAPTION' => $message_item[0]->caption,
                             'QUOTEDMSGBODY' => "" ,
                             'QUOTEDMSGID' => $message_item[0]->quotedMsgId,
                             'CHATNAME' =>$message_item[0]->chatName,
                             'ETIQUETA' => $etiqueta ,
                             'USER_VIEW' => '0'
             ]);
             
             
             
                
             $instancia = Config_wassap::first();  
             
             //deberia estar en recibe
             //Encotrar usuario en bot
             //Funciona unicamente en Perú o paises que tengan su cosigo con 2 caracteres y 9 numeros
             //si el bot esta activo para el usuario
             $cod_pais = substr($message_item[0]->author, 0 , 2);
             $numero = substr($message_item[0]->author, 2 , 9);
             $APIurl =  $instancia->URL;
             $token  =  $instancia->API_KEY;
             $fin_encuesta_termino=false; 
             //Buscar usuario en tabla de jobs de encuesta
             $job_encuesta_usuario= DB::table('tb_bot_temp_job_encuesta_usuario')->where('NUMERO',$numero)->where("STATUS_ULTIMA_RESPUESTA",0)->first();



/////bot*****************
              //Si no se encuentra con encuesta activa
              /*
              if($job_encuesta_usuario == null){
              
                 //Buscando
                 $bot_encuestas = DB::table('tb_bot_encuestas')->whereRaw('trim(lower(PALABRA_CLAVE)) = "'.trim(strtolower($message_item[0]->body)).'"')->where("ESTADO",1)->first();
                 //Si encuentra
                 if(isset($bot_encuestas->ID_ENCUESTA)){
                     
                    //Usuario ya contesto la encuesta 
                    $bot_preguntas = DB::table('tb_bot_resultados_encuesta_final')->where('NUMERO',$numero)->where('ID_ENCUESTA',$bot_encuestas->ID_ENCUESTA)->first();
                    //Si
                    if($bot_preguntas != null){
                        ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,"Ya participaste en esta encuesta." ,$APIurl,$token));
                    }
                    //No
                    else{
                       //enviamos mensaje de bienvenida
                       $mensaje = $bot_encuestas->MSM_BIENVENIDA.PHP_EOL.PHP_EOL;
                       //Buscamos la primer pregunta
                       $bot_preguntas = DB::table('tb_bot_preguntas')->where('ID_ENCUESTA',$bot_encuestas->ID_ENCUESTA)->first();
                       //Insertamos en la lista de encuestas activas
                       DB::table('tb_bot_temp_job_encuesta_usuario')->insert([
                          ['NUMERO' => $numero , 
                           'ID_ENCUESTA' => $bot_encuestas->ID_ENCUESTA,
                           'STATUS_MENSAJE_BIENBENIDA' => '1',
                           'STATUS_ULTIMA_PREGUNTA' => $bot_preguntas->ID_PREGUNTA  
                         ]
                       ]);
                       
                       //Enviamos la bienvenida
                       ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje,$APIurl,$token));
                       
                       $mensaje = "";
                       //Agregamos la pregunta al mensaje
                       $mensaje= $bot_preguntas->PREGUNTA;
                       //Obtenemos las opciones
                       $bot_preguntas_opciones = DB::table('tb_bot_preguntas_opciones')->where('ID_PREGUNTA',$bot_preguntas->ID_PREGUNTA)->where('ID_ENCUESTA',$bot_encuestas->ID_ENCUESTA)->get();
                       //Agregamos opciones a pregunta
                       foreach ($bot_preguntas_opciones as $item) {
                         $mensaje= $mensaje.PHP_EOL.$item->OPCION;  
                         if($item->OTRO==1){ 
                              DB::table('tb_bot_temp_job_encuesta_usuario')
                                 ->where('NUMERO',$numero )
                                 ->where('ID_ENCUESTA',$bot_encuestas->ID_ENCUESTA )
                                 ->update(array('STATUS_OTRO' => '1' ));
                              $mensaje=$mensaje.PHP_EOL.'Ingresar su respuesta en un solo mensaje';
                        }
                       }

                       sleep(3);

                       ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token)); 
                    }
                    
                    
                    
                 }
                 //Si no encuentra
                 else{
                    
                    
                    $bienvenida = \App\Botbienvenida::first();
                    
                    if($bienvenida != null){
                       if($bienvenida->ESTADO == 1){
                           if($bienvenida->IMG == 0){
                             
                             $mensaje = $bienvenida->MENSAJE;
                             ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                          }
                          else{
                             $mensaje = $bienvenida->MENSAJE;
                             $url = $bienvenida->URL_IMG;
                             ((new WhatsAppBot)->enviar_imagen_y_texto($cod_pais,$numero,$mensaje,$url,$APIurl,$token));
                          }
                       }
                    }
                 }
                 
              }
              //Si tiene encuesta activa
              else{

                 //Encontramos pregunta anterior
                 $bot_pregunta_item = DB::table('tb_bot_preguntas')->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->where('ID_PREGUNTA',$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA )->first();
                 //Vemos si aun existe la pregunta
                 if(isset($bot_pregunta_item->ID_PREGUNTA)){
                    //1er corrección: Ya no buscara la siguiente sumando 1 al id, si no por el siguiente mayor
                    $siguiente = \App\Botpreguntas::where('ID_PREGUNTA',">",$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA)->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->orderBy("ID_PREGUNTA","asc")->first();
                    //Validamos si la pregunta admite otras respuestas;
                    $opciones = \App\Botpreguntasopcion::where('ID_PREGUNTA',$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA)->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->where("OTRO",0)->pluck("CLAVE")->toArray();
                    $otro = \App\Botpreguntasopcion::where('ID_PREGUNTA',$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA)->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->where("OTRO",1)->first();
                    
                    $mensaje_recibido = (mb_strtolower($message_item[0]->body,'UTF-8'));
        
                    $continue = false;
                 
                    if(isset($otro->ID_OPCIONES) and ($job_encuesta_usuario->STATUS_ULTIMA_RESPUESTA=='0')){
                      
                       //Guardamos respuesta
                       if(!in_array($mensaje_recibido,$opciones)){
                          DB::table('tb_bot_resultados_encuesta_opciones')->insert([
                             ['ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                              'ID_PREGUNTA'=> $job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA,
                              'NUMERO' => $numero,
                              'PREGUNTA' => $bot_pregunta_item->PREGUNTA ,
                              'OPCION_CONTENIDO' => 'OTRO' ,
                              'OPCION_ESCOJIDA' => $mensaje_recibido,
                              'PESO'=> $otro->PESO   ]
                          ]);
                          $continue = true;
                       }
                       else{
                          $bot_preguntas_opciones = DB::table('tb_bot_preguntas_opciones')->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->where('ID_PREGUNTA',$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA)->where('CLAVE',$mensaje_recibido)->first(); 
                          DB::table('tb_bot_resultados_encuesta_opciones')->insert([
                                ['ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                                 'ID_PREGUNTA'=> $job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA,
                                 'NUMERO' => $numero,
                                 'PREGUNTA' => $bot_pregunta_item->PREGUNTA ,
                                 'OPCION_CONTENIDO' => $bot_preguntas_opciones->OPCION ,
                                 'OPCION_ESCOJIDA' => $mensaje_recibido,
                                 'PESO'=> $bot_preguntas_opciones->PESO]
                          ]);
                       
                          $continue = true;
                       }

                    }
                    else if(!isset($otro->ID_OPCIONES) and ($job_encuesta_usuario->STATUS_ULTIMA_RESPUESTA=='0')){
                       //Guardamos respuesta
                       if(in_array($mensaje_recibido,$opciones)){
                          
                          $bot_preguntas_opciones = DB::table('tb_bot_preguntas_opciones')->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->where('ID_PREGUNTA',$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA)->where('CLAVE',$mensaje_recibido)->first(); 
                          DB::table('tb_bot_resultados_encuesta_opciones')->insert([
                                ['ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                                 'ID_PREGUNTA'=> $job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA,
                                 'NUMERO' => $numero,
                                 'PREGUNTA' => $bot_pregunta_item->PREGUNTA ,
                                 'OPCION_CONTENIDO' => $bot_preguntas_opciones->OPCION ,
                                 'OPCION_ESCOJIDA' => $mensaje_recibido,
                                 'PESO'=> $bot_preguntas_opciones->PESO]
                          ]);
                       
                          $continue = true;
                       }
                       else{
                          $mensaje="Opción no valida"; 
                          ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                          
                          $continue = false;
                       }
                       
                    }
                    
                    //Evaluamos respuestas despues de guardar
                    if($continue === true){
                       
                       $bot_opcion = \App\Botpreguntasopcion::where("ID_ENCUESTA",$job_encuesta_usuario->ID_ENCUESTA)->where("ID_PREGUNTA",$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA)->whereRaw('trim(lower(CLAVE)) = "'.trim(strtolower($message_item[0]->body)).'"')->first();   
                       
                       
                       //Enviamos respuesta
                       if($bot_opcion->AUTO_RESPUESTA == 1){
                          
                        //   if($bot_opcion->IMG == 1){
                             
                        //      $mensaje=$bot_opcion->RESPUESTA;
                        //      $url=$bot_opcion->URL_IMAGEN;
                             
                        //      ((new WhatsAppBot)->enviar_imagen_y_texto($cod_pais,$numero,$mensaje,$url,$APIurl,$token));
                             
                        //   }
                        //   else{
                             $mensaje=$bot_opcion->RESPUESTA; 
                             ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                        //   }
                          
                       }
                    //    else if($bot_opcion->IMG == 1){
                          
                    //       $url=$bot_opcion->URL_IMAGEN;
                    //       ((new WhatsAppBot)->enviar_imagen($cod_pais,$numero,$url,$APIurl,$token));
                    //    }
                       
                       if(isset($siguiente->ID_PREGUNTA)){
                          
                          
                          DB::table('tb_bot_temp_job_encuesta_usuario')->where('NUMERO',$numero )->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )->update(array('STATUS_ULTIMA_PREGUNTA' => $siguiente->ID_PREGUNTA ,'STATUS_OTRO' => '0' ));
                          //enviar siguiente pregunta
                          $bot_preguntas = DB::table('tb_bot_preguntas')
                                   ->where('ID_ENCUESTA', $job_encuesta_usuario->ID_ENCUESTA )
                                   ->where('ID_PREGUNTA', $siguiente->ID_PREGUNTA )->first();
                          
                          if($bot_preguntas != null){
                             $mensaje = $bot_preguntas->PREGUNTA;                    
                             $bot_preguntas_opciones_item = DB::table('tb_bot_preguntas_opciones')
                                                               ->where('ID_PREGUNTA',$siguiente->ID_PREGUNTA)
                                                               ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->get(); 
                             foreach ($bot_preguntas_opciones_item as $item) {
                                              $mensaje= $mensaje.PHP_EOL.$item->OPCION;
                                              if($item->OTRO==1){
                                                  //el sistema detecta que no hay opciones para esta pregunta
                                                   DB::table('tb_bot_temp_job_encuesta_usuario')
                                                        ->where('NUMERO',$numero )
                                                        ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )
                                                        ->update(array('STATUS_OTRO' => '1' ));
                                                  $mensaje=$mensaje.PHP_EOL.'Ingresar su respuesta en un solo mensaje';
                                              }
                             }
                             ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                          
                       }
                       }
                       else{
                          
                          $peso_total = DB::table('tb_bot_resultados_encuesta_opciones')->where("ID_ENCUESTA",$job_encuesta_usuario->ID_ENCUESTA)->sum("PESO");
                          
                          $res = "";
                          
                          if($peso_total == null){
                             $peso_total = 0;
                          }
                          
                          $rango = \App\BotCalculo::where("ID_ENCUESTA",$job_encuesta_usuario->ID_ENCUESTA)->whereRaw($peso_total." between MINIMO and MAXIMO")->orderBy("MINIMO","DESC")->orderBy("ID_RESULTADO","desc")->first();
                          
                          if($rango != null){
                             $res = $rango->MENSAJE;
                          }
                          else{
                             $rango = \App\BotCalculo::where("ID_ENCUESTA",$job_encuesta_usuario->ID_ENCUESTA)->where("OTROS",1)->orderBy("ID_RESULTADO","desc")->first();
                             
                             if($rango != null){
                                $res = $rango->MENSAJE;
                             }
                          }
                          
                          DB::table('tb_bot_resultados_encuesta_final')->insert(
                          [[ 'ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                             'CONDICION'=> 'repeticion',
                               'NUMERO' => $numero,
                               'RESPUESTA' => $res,
                               'PUNTAJE_RESULTADO' => $peso_total ,
                           ]]);
                           
                          if($rango != null){
                             
                             if($rango->IMG){
                                $mensaje = $rango->MENSAJE;
                                $url= $rango->URL_IMG;
                                ((new WhatsAppBot)->enviar_imagen_y_texto($cod_pais,$numero,$mensaje,$url,$APIurl,$token));
                                sleep(5);
                             }
                             else{
                                $mensaje = $rango->MENSAJE;
                                ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                             }
                             
                             
                          }
                          
                          //ultima pregunta ya no hay mas
                          DB::table('tb_bot_temp_job_encuesta_usuario')->where('NUMERO',$numero )->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )->update(array('STATUS_ULTIMA_RESPUESTA' => '1' ));
                          $ultimo_mensaje = DB::table('tb_bot_encuestas')->where("ID_ENCUESTA",$job_encuesta_usuario->ID_ENCUESTA)->first();
                          if($ultimo_mensaje->MSM_DESPEDIDA != ""){
                             
                             $mensaje=$ultimo_mensaje->MSM_DESPEDIDA; 
                             ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                             
                          }
                       }
                       
                    }
                 }
                 else{
                    
                    $mensaje="Pregunta ya no valida, pasando a siguiente pregunta"; 
                    ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                    
                    $siguiente = \App\Botpreguntas::where('ID_PREGUNTA',">",$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA)->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->orderBy("ID_PREGUNTA","asc")->first();
                    
                    if(isset($siguiente->ID_PREGUNTA)){
                       
                       
                       DB::table('tb_bot_temp_job_encuesta_usuario')->where('NUMERO',$numero )->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )->update(array('STATUS_ULTIMA_PREGUNTA' => $siguiente->ID_PREGUNTA ,'STATUS_OTRO' => '0' ));
                       //enviar siguiente pregunta
                       $bot_preguntas = DB::table('tb_bot_preguntas')
                                ->where('ID_ENCUESTA', $job_encuesta_usuario->ID_ENCUESTA )
                                ->where('ID_PREGUNTA', $siguiente->ID_PREGUNTA )->first();
                       
                       if($bot_preguntas != null){
                          $mensaje = $mensaje.''.$bot_preguntas->PREGUNTA;                    
                          $bot_preguntas_opciones_item = DB::table('tb_bot_preguntas_opciones')
                                                            ->where('ID_PREGUNTA',$siguiente->ID_PREGUNTA)
                                                            ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->get(); 
                          foreach ($bot_preguntas_opciones_item as $item) {
                                           $mensaje= $mensaje.PHP_EOL.$item->OPCION;
                                           if($item->OTRO==1){
                                               //el sistema detecta que no hay opciones para esta pregunta
                                                DB::table('tb_bot_temp_job_encuesta_usuario')
                                                     ->where('NUMERO',$numero )
                                                     ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )
                                                     ->update(array('STATUS_OTRO' => '1' ));
                                               $mensaje=$mensaje.PHP_EOL.'Ingresar su respuesta en un solo mensaje';
                                           }
                          }
                          ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                       
                       }
                    }
                    else{
                       
                       $peso_total = DB::table('tb_bot_resultados_encuesta_opciones')->where("ID_ENCUESTA",$job_encuesta_usuario->ID_ENCUESTA)->sum("PESO");
                          
                       $res = "";
                       
                       if($peso_total == null){
                          $peso_total = 0;
                       }
                       
                       $rango = \App\BotCalculo::where("ID_ENCUESTA",$job_encuesta_usuario->ID_ENCUESTA)->whereRaw($peso_total." between MINIMO and MAXIMO")->orderBy("MINIMO","DESC")->orderBy("ID_RESULTADO","desc")->first();
                       
                       if($rango != null){
                          $res = $rango->MENSAJE;
                       }
                       else{
                          $rango = \App\BotCalculo::where("ID_ENCUESTA",$job_encuesta_usuario->ID_ENCUESTA)->where("OTROS",1)->orderBy("ID_RESULTADO","desc")->first();
                          
                          if($rango != null){
                             $res = $rango->MENSAJE;
                          }
                       }
                       
                       DB::table('tb_bot_resultados_encuesta_final')->insert(
                       [[ 'ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                          'CONDICION'=> 'repeticion',
                            'NUMERO' => $numero,
                            'RESPUESTA' => $res,
                            'PUNTAJE_RESULTADO' => $peso_total ,
                        ]]);
                        
                       if($rango != null){
                          
                          if($rango->IMG){
                             $mensaje = $rango->MENSAJE;
                             $url= $rango->URL_IMG;
                             ((new WhatsAppBot)->enviar_imagen_y_texto($cod_pais,$numero,$mensaje,$url,$APIurl,$token));
                              sleep(5);
                          }
                          else{
                             $mensaje = $rango->MENSAJE;
                             ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                          }
                          
                         
                       }
                       
                       //ultima pregunta ya no hay mas
                       DB::table('tb_bot_temp_job_encuesta_usuario')->where('NUMERO',$numero )->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )->update(array('STATUS_ULTIMA_RESPUESTA' => '1' ));
                       $ultimo_mensaje = DB::table('tb_bot_encuestas')->where("ID_ENCUESTA",$job_encuesta_usuario->ID_ENCUESTA)->first();
                       if($ultimo_mensaje->MSM_DESPEDIDA != ""){
                          
                          $mensaje=$ultimo_mensaje->MSM_DESPEDIDA; 
                          ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                          
                       }

                    }
                 }
              }*/
/////bot*****************

          }


            /*if(!(isset($job_encuesta_usuario->NUMERO))){//el numero no se encuesntra realizando encuesta BIENVENIDO
                   $bot_encuestas = DB::table('tb_bot_encuestas')
                         ->whereRaw('trim(lower(PALABRA_CLAVE)) = "'.trim(strtolower($message_item[0]->body)).'"')->first();
                         
                 
                   if(isset($bot_encuestas->ID_ENCUESTA)){
                       
                       
                       //new
                       $bot_preguntas = DB::table('tb_bot_resultados_encuesta_final')
                                         ->where('NUMERO',$numero )
                                         ->where('ID_ENCUESTA',$bot_encuestas->ID_ENCUESTA)->first();
                       if($bot_preguntas){
                           ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,"Estimado usuario usted ya participo en la encuesta" ,$APIurl,$token));
                       }else{
                           $mensaje = $bot_encuestas->MSM_BIENVENIDA.PHP_EOL.PHP_EOL;
                           $bot_preguntas = DB::table('tb_bot_preguntas')
                                             ->where('ID_ENCUESTA',$bot_encuestas->ID_ENCUESTA)->first();
                           
                           DB::table('tb_bot_temp_job_encuesta_usuario')->insert([
                                   ['NUMERO' => $numero , 
                                    'ID_ENCUESTA' => $bot_encuestas->ID_ENCUESTA,
                                    'STATUS_MENSAJE_BIENBENIDA' => '1',
                                    'STATUS_ULTIMA_PREGUNTA' => $bot_preguntas->ID_PREGUNTA  
                                  ]
                           ]);
                           
                           $mensaje= $mensaje.''.$bot_preguntas->PREGUNTA;                    
                           $bot_preguntas_opciones = DB::table('tb_bot_preguntas_opciones')
                                                 ->where('ID_PREGUNTA',$bot_preguntas->ID_PREGUNTA)
                                                 ->where('ID_ENCUESTA',$bot_encuestas->ID_ENCUESTA)->get(); 
                           foreach ($bot_preguntas_opciones as $item) {
                                  $mensaje= $mensaje.PHP_EOL.$item->OPCION;  
                                  if($item->OTRO==1){
                                       DB::table('tb_bot_temp_job_encuesta_usuario')
                                          ->where('NUMERO',$numero )
                                          ->where('ID_ENCUESTA',$bot_encuestas->ID_ENCUESTA )
                                          ->update(array('STATUS_OTRO' => '1' ));
                                       $mensaje=$mensaje.PHP_EOL.'Ingresar su respuesta en un solo mensaje';
                                 }
                           }
                           ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));  
                       }
                   }      
             }else{
                 if(isset($job_encuesta_usuario->NUMERO)){
                          $bot_pregunta_item = DB::table('tb_bot_preguntas')
                                         ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)
                                         ->where('ID_PREGUNTA',$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA )->first();
                          if (isset($bot_pregunta_item->ID_PREGUNTA)){  
                                 $siguiente = intval($bot_pregunta_item->ID_PREGUNTA) + 1;
                                 
                                 $mensaje="";
                                 //validar si respuesta requiere texto , si el texto es ingresado de manera manual y no es opcion almacenar sino elejir opcion
                                 //tb_bot_preguntas_opciones OTRO=0 no =1 si
                                 //INDICA AL SISTEMA ESPERA D EMENSAJE OTRO
                                 if( ($job_encuesta_usuario->STATUS_OTRO=='1') and ($job_encuesta_usuario->STATUS_ULTIMA_RESPUESTA=='0') 
                                         and (!((mb_strtolower($message_item[0]->body,'UTF-8')=='a')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='b')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='c')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='d')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='e')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='f')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='g')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='h')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='i')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='j'))) ){
                                    
                                         //bot_preguntas_opciones = DB::table('tb_bot_preguntas_opciones')
                                           //     ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)
                                             //   ->where('ID_PREGUNTA',$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA)->get(); 
                   
                                         //guardar respuesta
                                         DB::table('tb_bot_resultados_encuesta_opciones')->insert([
                                               ['ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                                                'ID_PREGUNTA'=> $job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA,
                                                'NUMERO' => $numero,
                                                'PREGUNTA' => $bot_pregunta_item->PREGUNTA ,
                                                'OPCION_CONTENIDO' => 'OTRO' ,
                                                'OPCION_ESCOJIDA' => mb_strtolower($message_item[0]->body,'UTF-8'),
                                                'PESO'=> '0'   ]
                                         ]);
                                         
                                         DB::table('tb_bot_temp_job_encuesta_usuario')
                                                                 ->where('NUMERO',$numero )
                                                                 ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )
                                                                 ->update(array('STATUS_ULTIMA_PREGUNTA' => $siguiente ,'STATUS_OTRO' => '0' ));
                                
                                         //enviar siguiente pregunta
                                         $bot_preguntas = DB::table('tb_bot_preguntas')
                                                  ->where('ID_ENCUESTA', $job_encuesta_usuario->ID_ENCUESTA )
                                                  ->where('ID_PREGUNTA', $siguiente )->first();
                                         
                                         if($bot_preguntas){
                                            $mensaje = $mensaje.''.$bot_preguntas->PREGUNTA;                    
                                            $bot_preguntas_opciones_item = DB::table('tb_bot_preguntas_opciones')
                                                                              ->where('ID_PREGUNTA',$siguiente)
                                                                              ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->get(); 
                                            foreach ($bot_preguntas_opciones_item as $item) {
                                                             $mensaje= $mensaje.PHP_EOL.$item->OPCION;
                                                             if($item->OTRO==1){
                                                                 //el sistema detecta que no hay opciones para esta pregunta
                                                                  DB::table('tb_bot_temp_job_encuesta_usuario')
                                                                       ->where('NUMERO',$numero )
                                                                       ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )
                                                                       ->update(array('STATUS_OTRO' => '1' ));
                                                                 $mensaje=$mensaje.PHP_EOL.'Ingresar su respuesta en un solo mensaje';
                                                             }
                                            }
                                            ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$siguiente.','.$mensaje ,$APIurl,$token));  
                                         }else{
                                            //ultima pregunta ya no hay mas
                                            DB::table('tb_bot_temp_job_encuesta_usuario')
                                                ->where('NUMERO',$numero )
                                                ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )
                                                ->update(array('STATUS_ULTIMA_RESPUESTA' => '1' ));
                                         }
                                 }else if(($job_encuesta_usuario->STATUS_ULTIMA_RESPUESTA=='0')){
                                        
                                       if(     (mb_strtolower($message_item[0]->body,'UTF-8')=='a')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='b')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='c')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='d')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='e')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='f')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='g')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='h')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='i')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='j') ){
                                                
                                               $temp_op="";
                                               switch(mb_strtolower($message_item[0]->body,'UTF-8')){
                                                 case 'a': { $temp_op='a'; break; }
                                                 case 'b': { $temp_op='b'; break; }
                                                 case 'c': { $temp_op='c'; break; }
                                                 case 'd': { $temp_op='d'; break; }
                                                 case 'e': { $temp_op='e'; break; }
                                                 case 'f': { $temp_op='f'; break; }
                                                 case 'g': { $temp_op='g'; break; }
                                                 case 'h': { $temp_op='h'; break; }
                                                 case 'i': { $temp_op='i'; break; }
                                                 case 'j': { $temp_op='j'; break; }
                                                 default:  { 
                                                     break;
                                               }}
                                               
                                               //evaluar caso a
                                                         $bot_preguntas_opciones = DB::table('tb_bot_preguntas_opciones')
                                                               ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)
                                                               ->where('ID_PREGUNTA',$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA)
                                                               ->where('CLAVE',$temp_op)->first(); 
                                                               
                                                        if($bot_preguntas_opciones){
                                                           
                                                            DB::table('tb_bot_temp_job_encuesta_usuario')
                                                                      ->where('NUMERO',$numero )
                                                                      ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )
                                                                      ->update(array('STATUS_ULTIMA_PREGUNTA' => $siguiente ));
                                                                      
                                                            //guardar respuesta
                                                            DB::table('tb_bot_resultados_encuesta_opciones')->insert([
                                                                    ['ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                                                                     'ID_PREGUNTA'=> $job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA,
                                                                     'NUMERO' => $numero,
                                                                     'PREGUNTA' => $bot_pregunta_item->PREGUNTA ,
                                                                     'OPCION_CONTENIDO' => $bot_preguntas_opciones->OPCION ,
                                                                     'OPCION_ESCOJIDA' => $temp_op,
                                                                     'PESO'=> $bot_preguntas_opciones->PESO   ]
                                                            ]);
                                                         
                                                           if($bot_preguntas_opciones->AUTO_RESPUESTA=='1'){
                                                              ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$bot_preguntas_opciones->RESPUESTA ,$APIurl,$token)); 
                                                           }
                                                         
                                                            //enviar pregunta suguiente
                                                            $bot_preguntas = DB::table('tb_bot_preguntas')
                                                              ->where('ID_ENCUESTA', $job_encuesta_usuario->ID_ENCUESTA )
                                                              ->where('ID_PREGUNTA', $siguiente )->first();
                                                            if($bot_preguntas){
                                                                $mensaje = $mensaje.''.$bot_preguntas->PREGUNTA;                    
                                                                $bot_preguntas_opciones_item = DB::table('tb_bot_preguntas_opciones')
                                                                                                  ->where('ID_PREGUNTA',$siguiente)
                                                                                                  ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->get(); 
                                                                $switch_img=false;
                                                                foreach ($bot_preguntas_opciones_item as $item) {
                                                                                 
                                                                                 if($item->IMG==1){
                                                                                    if($switch_img==false){  ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$siguiente.','.$mensaje ,$APIurl,$token));  }
                                                                                    $switch_img=true;
                                                                                    $parametro="";
                                                                                    if($temp_op=='a'){$parametro='hombre';}
                                                                                    if($temp_op=='b'){$parametro='mujer';}
                                                                                    if($temp_op=='c'){$parametro='ambos';}
                                                                                    $url= str_replace("%parameter%", $parametro,  $item->URL_IMAGEN );
                                                                                    ((new WhatsAppBot)->enviar_imagen_y_texto($cod_pais,$numero,$item->OPCION,$url,$APIurl,$token));
                                                                                 }else{
                                                                                    $mensaje= $mensaje.PHP_EOL.$item->OPCION;
                                                                                    if($item->OTRO==1){
                                                                                        //el sistema detepta que no hay opciones para esta pregunta
                                                                                         DB::table('tb_bot_temp_job_encuesta_usuario')
                                                                                              ->where('NUMERO',$numero )
                                                                                              ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )
                                                                                              ->update(array('STATUS_OTRO' => '1' ));
                                                                                        $mensaje=$mensaje.PHP_EOL.'Ingresar su respuesta en un solo mensaje';
                                                                                    }
                                                                                 }
                                                                }
                                                                if($switch_img==false){
                                                                    ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$siguiente.','.$mensaje ,$APIurl,$token)); 
                                                                }
                                                             }else{
                                                                //ultima pregunta ya no hay mas
                                                                DB::table('tb_bot_temp_job_encuesta_usuario')
                                                                    ->where('NUMERO',$numero )
                                                                    ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )
                                                                    ->update(array('STATUS_ULTIMA_RESPUESTA' => '1' ));
                                                             }
                                                           
                                                        }else{
                                                           $mensaje="Estimado por favor digitar una opción correcta, solo digite la letra correspondiente ejemplo:  a  "; 
                                                           ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token)); 
                                                           
                                                        }

                                                         
                                                        
                                               
                                       
                                       }else{
                                           $mensaje="Estimado por favor digitar una opción correcta, solo digite la letra correspondiente ejemplo:  a  "; 
                                           ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));  
                                       }
                                           
                                 }
                          }
                          
                          
                          $job_encuesta_usuario= DB::table('tb_bot_temp_job_encuesta_usuario')
                                                 ->where('NUMERO',$numero)->first();
                          
                          
                          if($job_encuesta_usuario->STATUS_ULTIMA_RESPUESTA=='1'){
                                 //calcular puntaje
                                 //calcular scor
                                      //tb_bot_resultados_encuesta_final guardar
                                       $list_resultados_encuesta_opciones= DB::table('tb_bot_resultados_encuesta_opciones')
                                         ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)
                                         ->where('NUMERO',$numero)->get();
                                         
                                       if($job_encuesta_usuario->ID_ENCUESTA==3){
                                          $a=0;$b=0; $c=0;$d=0;$e=0;$f=0;
                                          foreach ($list_resultados_encuesta_opciones as $op) {
                                             if ($op->OPCION_ESCOJIDA=='a'){$a++;}
                                             if ($op->OPCION_ESCOJIDA=='b'){$b++;}
                                             if ($op->OPCION_ESCOJIDA=='c'){$c++;}
                                             if ($op->OPCION_ESCOJIDA=='d'){$d++;}
                                             if ($op->OPCION_ESCOJIDA=='e'){$e++;}
                                             if ($op->OPCION_ESCOJIDA=='f'){$f++;}
                                          } 
                                          $res="";
                                          $imagen = "";
                                          if($a >= $b and $a>= $c and $a>= $d and $a>=$e and $a>=$f ){
                                              $res="Mayoría de a: Tu color es el Azul. ¡Felicitaciones! Estás atravesando está cuarentena intentando mantener la paz, tranquilidad y armonía.";
                                              $imagen = "https://epidemiasperu.com/bot_img/salud_mental/a2.png";
                                          }else if($b >= $a and $b>= $c and $b>= $d and $b>=$e and $b>=$f){
                                              $res="Mayoría de b: Tu color es el Amarillo. A pesar de estar en un momento complicado, tu mantienes el optimismo y lo contagias a los demás, ¡sigue así!.";
                                              $imagen = "https://epidemiasperu.com/bot_img/salud_mental/b2.png";
                                              
                                          }else if($c >= $b and $c>= $a and $c>= $d and $c>=$e and $c>=$f){
                                              $res="Mayoría de c: Tu color es el Morado. En esta cuarentena te estás llenando de emociones como la rabia y la agresividad. Te recomendamos pensar en cómo te sientes y el porqué te estas sintiendo así. Es importante que converses de tus sentimientos con familiares y amigos y estar abierto a escuchar sus consejos.";
                                              $imagen = "https://epidemiasperu.com/bot_img/salud_mental/c2.png";
                                              
                                          }else if($d >= $b and $d>= $c and $d>= $a and $d>=$e and $d>=$f){
                                              $res="Mayoría de d: Tu color es el Plomo. Este tiempo de cuarentena deja en ti una sensación de tristeza, pérdida y desilusión que no son buenos para tu salud mental. Te recomendamos conversar sobre ello con tus familiares y amigos. Asimismo, hacer deporte en casa e intentar dormir tus 8 horas diarias.";
                                              $imagen = "https://epidemiasperu.com/bot_img/salud_mental/d2.png";
                                              
                                          }else if($e >= $b and $e>= $c and $e>= $d and $e>=$a and $e>=$f){
                                              $res="Mayoría de e: Tu color es el Gris Oscuro. Si bien todo es nuevo y no sabemos bien a qué nos estamos enfrentando o cómo será la “nueva normalidad”, no debemos dejarnos ganar por el miedo. Te recomendamos descansar lo suficiente, hacer ejercicio en casa y organizar tus horarios para lograr vencer la parálisis en la que nos suele sumergir el miedo. ¡Tú puedes!";
                                              $imagen = "https://epidemiasperu.com/bot_img/salud_mental/e2.png";
                                              
                                          }else if($f >= $b and $f>= $c and $f>= $d and $f>=$e and $f>=$a){
                                              $res="Mayoría de f: Tu color es el rosado. ¡A buena hora! Estás pasando esta cuarentena rodeado de alegría y con mucho cariño. Aprovecha ese vínculo con tus más cercanos para seguir reforzando esta emoción.";
                                              $imagen = "https://epidemiasperu.com/bot_img/salud_mental/f2.png";
                                              
                                          }else{
                                              $res="Mayoría de a: Tu color es el Azul. ¡Felicitaciones! Estás atravesando está cuarentena intentando mantener la paz, tranquilidad y armonía.
                                                    Mayoría de b: Tu color es el Amarillo. A pesar de estar en un momento complicado, tu mantienes el optimismo y lo contagias a los demás, ¡sigue así!.
                                                    Mayoría de c: Tu color es el Morado. En esta cuarentena te estás llenando de emociones como la rabia y la agresividad. Te recomendamos pensar en cómo te sientes y el porqué te estas sintiendo así. Es importante que converses de tus sentimientos con familiares y amigos y estar abierto a escuchar sus consejos.
                                                    Mayoría de d: Tu color es el Plomo. Este tiempo de cuarentena deja en ti una sensación de tristeza, pérdida y desilusión que no son buenos para tu salud mental. Te recomendamos conversar sobre ello con tus familiares y amigos. Asimismo, hacer deporte en casa e intentar dormir tus 8 horas diarias.
                                                    Mayoría de e: Tu color es el Gris Oscuro. Si bien todo es nuevo y no sabemos bien a qué nos estamos enfrentando o cómo será la “nueva normalidad”, no debemos dejarnos ganar por el miedo. Te recomendamos descansar lo suficiente, hacer ejercicio en casa y organizar tus horarios para lograr vencer la parálisis en la que nos suele sumergir el miedo. ¡Tú puedes!
                                                    Mayoría de f: Tu color es el rosado. ¡A buena hora! Estás pasando esta cuarentena rodeado de alegría y con mucho cariño. Aprovecha ese vínculo con tus más cercanos para seguir reforzando esta emoción.";
                                          }
                                          
                                          //despedida
                                          $bot_encuestas = DB::table('tb_bot_encuestas')
                                                           ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )->first();
                                          //((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$bot_encuestas->MSM_DESPEDIDA ,$APIurl,$token)); 
                                          $res=$res.''.PHP_EOL.$bot_encuestas->MSM_DESPEDIDA;
                                          if($imagen==""){
                                              ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$res ,$APIurl,$token));
                                          }else {
                                              ((new WhatsAppBot)->enviar_imagen_y_texto($cod_pais,$numero,$res,$imagen,$APIurl,$token));
                                          }
                                       
                                          DB::table('tb_bot_resultados_encuesta_final')->insert([
                                                                     ['ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                                                                      'CONDICION'=> 'repeticion',
                                                                      'NUMERO' => $numero,
                                                                      'RESPUESTA' => $res,
                                                                      'PUNTAJE_RESULTADO' => '' ,
                                                                      ]
                                                             ]);
                                          
                                       }
                                       
                                       if($job_encuesta_usuario->ID_ENCUESTA==1 or $job_encuesta_usuario->ID_ENCUESTA==4 or $job_encuesta_usuario->ID_ENCUESTA==5){
                                           
                                           //despedida
                                         $bot_encuestas = DB::table('tb_bot_encuestas')
                                                           ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )->first();
                                         ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$bot_encuestas->MSM_DESPEDIDA ,$APIurl,$token));
                                         DB::table('tb_bot_resultados_encuesta_final')->insert([
                                                                     ['ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                                                                      'CONDICION'=> 'libre',
                                                                      'NUMERO' => $numero,
                                                                      'RESPUESTA' => '',
                                                                      'PUNTAJE_RESULTADO' => '' ,
                                                                      ]
                                                             ]);
                                           
                                       }
                                       
                                       if($job_encuesta_usuario->ID_ENCUESTA==2){
                                           
                                           //despedida
                                           
                                         $res="Reflexión final".PHP_EOL.
                                              "Recuerda que no necesitas a alguien para estar completo, tu ya eres una persona completa y no necesitas a nadie para ser feliz. Una pareja no te completa sino que te acompaña en el proceso de crecer y ser mejor persona. ".PHP_EOL.
                                               "Servicios".PHP_EOL.
                                               "Si eres parte de una   relación violenta o conoces a alguien que lo sea, estos son algunos espacios en los que pueden ayudarte:".PHP_EOL.
                                               "chat 100 (www.mimp.gob.pe/chat100),pueden ayudarte a identificar situaciones de riesgo en tu relación y darte muy buenos consejos.".PHP_EOL.
                                               "Centro de Emergencia Mujer: puedesir a hablar sobre cómo te sientes o a denunciar un caso de violencia".PHP_EOL.
                                               "Llamando a la línea 100, sólo  marca en tu teléfono el número 100, ¡atiende las 24h!, ellos pueden derivarte para una atención especializada y tomar la denuncia del caso.";
                                         
                                         ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero , $res ,$APIurl,$token));
                                         
                                         
                                         $bot_encuestas = DB::table('tb_bot_encuestas')
                                                           ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )->first();
                                         ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$bot_encuestas->MSM_DESPEDIDA ,$APIurl,$token));
                                         DB::table('tb_bot_resultados_encuesta_final')->insert([
                                                                     ['ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                                                                      'CONDICION'=> 'libre',
                                                                      'NUMERO' => $numero,
                                                                      'RESPUESTA' => '',
                                                                      'PUNTAJE_RESULTADO' => '' ,
                                                                      ]
                                                             ]);
                                           
                                       }
                                       
                                       
                                          
                                       //tb_bot_resultados_encuesta_final
                                       
                                       DB::table('tb_bot_temp_job_encuesta_usuario')->where('NUMERO', $numero)->delete(); 
                          }
                          
                 }
             }      
           */
             
         
       }
       

       /*if ($request->has('messages')) {
          $message_encore = json_encode($request->get("messages"));
          $message_item = json_decode($message_encore);
          //almacenar datos recibidos de usuarios wassap
          $contacto='0';
          $etiqueta = 'No se encontro ninguna etiqueta';
          
          if ($message_item[0]->fromMe==''  && \Str::contains($message_item[0]->chatId,"-") == false) { 
             file_put_contents("received.log",print_r( json_decode($b ,true),true), FILE_APPEND );
             $id_contacto = Sent::select('ID_CONTACTO','ETIQUETA')->where('CHATID', $message_item[0]->chatId )->orderBy('created_at', 'desc')->first() ; //
             if(isset($id_contacto->ID_CONTACTO)){
                 $contacto = $id_contacto->ID_CONTACTO;
                 $etiqueta = $id_contacto->ETIQUETA;
             }
             $Recive = Recive::create([
                             'ID_RECIVE' => $message_item[0]->id,
                             'ID_CONTACTO' =>  $contacto,
                             'BODY' => $message_item[0]->body,
                             'AUTHOR' => $message_item[0]->author,
                             'TIME' => $message_item[0]->time,
                             'CHATID' =>$message_item[0]-> chatId,
                             'TYPE' => $message_item[0]->type,
                             'SENDERNAME' => $message_item[0]->senderName,
                             'CAPTION' => $message_item[0]->caption,
                             'QUOTEDMSGBODY' =>$message_item[0]->quotedMsgBody ,
                             'QUOTEDMSGID' => $message_item[0]->quotedMsgId,
                             'CHATNAME' =>$message_item[0]->chatName,
                             'ETIQUETA' => $etiqueta ,
                             'USER_VIEW' => '0'
             ]);
             
             
             
                
             $instancia = Config_wassap::first();  
             
             //deberia estar en recibe
             //Encotrar usuario en bot
             //Funciona unicamente en Perú o paises que tengan su cosigo con 2 caracteres y 9 numeros
             //si el bot esta activo para el usuario
             $cod_pais = substr($message_item[0]->author, 0 , 2);
             $numero = substr($message_item[0]->author, 2 , 9);
             $APIurl =  $instancia->URL;
             $token  =  $instancia->API_KEY;
             $fin_encuesta_termino=false; 
             //Buscar usuario en tabla de jobs de encuesta
             $job_encuesta_usuario= DB::table('tb_bot_temp_job_encuesta_usuario')->where('NUMERO',$numero)->where("STATUS_ULTIMA_RESPUESTA",0)->first();

              //Si no se encuentra con encuesta activa
              
              if($job_encuesta_usuario == null){
              
                 //Buscando
                 $bot_encuestas = DB::table('tb_bot_encuestas')->whereRaw('trim(lower(PALABRA_CLAVE)) = "'.trim(strtolower($message_item[0]->body)).'"')->where("ESTADO",1)->first();
                 //Si encuentra
                 if(isset($bot_encuestas->ID_ENCUESTA)){
                     
                    //Usuario ya contesto la encuesta 
                    $bot_preguntas = DB::table('tb_bot_resultados_encuesta_final')->where('NUMERO',$numero)->where('ID_ENCUESTA',$bot_encuestas->ID_ENCUESTA)->first();
                    //Si
                    if($bot_preguntas != null){
                        ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,"Ya participaste en esta encuesta." ,$APIurl,$token));
                    }
                    //No
                    else{
                       //enviamos mensaje de bienvenida
                       $mensaje = $bot_encuestas->MSM_BIENVENIDA.PHP_EOL.PHP_EOL;
                       //Buscamos la primer pregunta
                       $bot_preguntas = DB::table('tb_bot_preguntas')->where('ID_ENCUESTA',$bot_encuestas->ID_ENCUESTA)->first();
                       //Insertamos en la lista de encuestas activas
                       DB::table('tb_bot_temp_job_encuesta_usuario')->insert([
                          ['NUMERO' => $numero , 
                           'ID_ENCUESTA' => $bot_encuestas->ID_ENCUESTA,
                           'STATUS_MENSAJE_BIENBENIDA' => '1',
                           'STATUS_ULTIMA_PREGUNTA' => $bot_preguntas->ID_PREGUNTA  
                         ]
                       ]);
                       
                       //Enviamos la bienvenida
                       ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje,$APIurl,$token));
                       
                       $mensaje = "";
                       //Agregamos la pregunta al mensaje
                       $mensaje= $bot_preguntas->PREGUNTA;
                       //Obtenemos las opciones
                       $bot_preguntas_opciones = DB::table('tb_bot_preguntas_opciones')->where('ID_PREGUNTA',$bot_preguntas->ID_PREGUNTA)->where('ID_ENCUESTA',$bot_encuestas->ID_ENCUESTA)->get();
                       //Agregamos opciones a pregunta
                       foreach ($bot_preguntas_opciones as $item) {
                         $mensaje= $mensaje.PHP_EOL.$item->OPCION;  
                         if($item->OTRO==1){ 
                              DB::table('tb_bot_temp_job_encuesta_usuario')
                                 ->where('NUMERO',$numero )
                                 ->where('ID_ENCUESTA',$bot_encuestas->ID_ENCUESTA )
                                 ->update(array('STATUS_OTRO' => '1' ));
                              $mensaje=$mensaje.PHP_EOL.'Ingresar su respuesta en un solo mensaje';
                        }
                       }

                       sleep(3);

                       ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token)); 
                    }
                    
                    
                    
                 }
                 //Si no encuentra
                 else{
                    
                    
                    $bienvenida = \App\Botbienvenida::first();
                    
                    if($bienvenida != null){
                       if($bienvenida->ESTADO == 1){
                           if($bienvenida->IMG == 0){
                             
                             $mensaje = $bienvenida->MENSAJE;
                             ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                          }
                          else{
                             $mensaje = $bienvenida->MENSAJE;
                             $url = $bienvenida->URL_IMG;
                             ((new WhatsAppBot)->enviar_imagen_y_texto($cod_pais,$numero,$mensaje,$url,$APIurl,$token));
                          }
                       }
                    }
                 }
                 
              }
              //Si tiene encuesta activa
              else{

                 //Encontramos pregunta anterior
                 $bot_pregunta_item = DB::table('tb_bot_preguntas')->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->where('ID_PREGUNTA',$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA )->first();
                 //Vemos si aun existe la pregunta
                 if(isset($bot_pregunta_item->ID_PREGUNTA)){
                    //1er corrección: Ya no buscara la siguiente sumando 1 al id, si no por el siguiente mayor
                    $siguiente = \App\Botpreguntas::where('ID_PREGUNTA',">",$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA)->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->orderBy("ID_PREGUNTA","asc")->first();
                    //Validamos si la pregunta admite otras respuestas;
                    $opciones = \App\Botpreguntasopcion::where('ID_PREGUNTA',$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA)->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->where("OTRO",0)->pluck("CLAVE")->toArray();
                    $otro = \App\Botpreguntasopcion::where('ID_PREGUNTA',$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA)->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->where("OTRO",1)->first();
                    
                    $mensaje_recibido = (mb_strtolower($message_item[0]->body,'UTF-8'));
        
                    $continue = false;
                 
                    if(isset($otro->ID_OPCIONES) and ($job_encuesta_usuario->STATUS_ULTIMA_RESPUESTA=='0')){
                      
                       //Guardamos respuesta
                       if(!in_array($mensaje_recibido,$opciones)){
                          DB::table('tb_bot_resultados_encuesta_opciones')->insert([
                             ['ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                              'ID_PREGUNTA'=> $job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA,
                              'NUMERO' => $numero,
                              'PREGUNTA' => $bot_pregunta_item->PREGUNTA ,
                              'OPCION_CONTENIDO' => 'OTRO' ,
                              'OPCION_ESCOJIDA' => $mensaje_recibido,
                              'PESO'=> $otro->PESO   ]
                          ]);
                          $continue = true;
                       }
                       else{
                          $bot_preguntas_opciones = DB::table('tb_bot_preguntas_opciones')->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->where('ID_PREGUNTA',$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA)->where('CLAVE',$mensaje_recibido)->first(); 
                          DB::table('tb_bot_resultados_encuesta_opciones')->insert([
                                ['ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                                 'ID_PREGUNTA'=> $job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA,
                                 'NUMERO' => $numero,
                                 'PREGUNTA' => $bot_pregunta_item->PREGUNTA ,
                                 'OPCION_CONTENIDO' => $bot_preguntas_opciones->OPCION ,
                                 'OPCION_ESCOJIDA' => $mensaje_recibido,
                                 'PESO'=> $bot_preguntas_opciones->PESO]
                          ]);
                       
                          $continue = true;
                       }

                    }
                    else if(!isset($otro->ID_OPCIONES) and ($job_encuesta_usuario->STATUS_ULTIMA_RESPUESTA=='0')){
                       //Guardamos respuesta
                       if(in_array($mensaje_recibido,$opciones)){
                          
                          $bot_preguntas_opciones = DB::table('tb_bot_preguntas_opciones')->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->where('ID_PREGUNTA',$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA)->where('CLAVE',$mensaje_recibido)->first(); 
                          DB::table('tb_bot_resultados_encuesta_opciones')->insert([
                                ['ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                                 'ID_PREGUNTA'=> $job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA,
                                 'NUMERO' => $numero,
                                 'PREGUNTA' => $bot_pregunta_item->PREGUNTA ,
                                 'OPCION_CONTENIDO' => $bot_preguntas_opciones->OPCION ,
                                 'OPCION_ESCOJIDA' => $mensaje_recibido,
                                 'PESO'=> $bot_preguntas_opciones->PESO]
                          ]);
                       
                          $continue = true;
                       }
                       else{
                          $mensaje="Opción no valida"; 
                          ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                          
                          $continue = false;
                       }
                       
                    }
                    
                    //Evaluamos respuestas despues de guardar
                    if($continue === true){
                       
                       $bot_opcion = \App\Botpreguntasopcion::where("ID_ENCUESTA",$job_encuesta_usuario->ID_ENCUESTA)->where("ID_PREGUNTA",$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA)->whereRaw('trim(lower(CLAVE)) = "'.trim(strtolower($message_item[0]->body)).'"')->first();   
                       
                       
                       //Enviamos respuesta
                       if($bot_opcion->AUTO_RESPUESTA == 1){
                          
                        //   if($bot_opcion->IMG == 1){
                             
                        //      $mensaje=$bot_opcion->RESPUESTA;
                        //      $url=$bot_opcion->URL_IMAGEN;
                             
                        //      ((new WhatsAppBot)->enviar_imagen_y_texto($cod_pais,$numero,$mensaje,$url,$APIurl,$token));
                             
                        //   }
                        //   else{
                             $mensaje=$bot_opcion->RESPUESTA; 
                             ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                        //   }
                          
                       }
                    //    else if($bot_opcion->IMG == 1){
                          
                    //       $url=$bot_opcion->URL_IMAGEN;
                    //       ((new WhatsAppBot)->enviar_imagen($cod_pais,$numero,$url,$APIurl,$token));
                    //    }
                       
                       if(isset($siguiente->ID_PREGUNTA)){
                          
                          
                          DB::table('tb_bot_temp_job_encuesta_usuario')->where('NUMERO',$numero )->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )->update(array('STATUS_ULTIMA_PREGUNTA' => $siguiente->ID_PREGUNTA ,'STATUS_OTRO' => '0' ));
                          //enviar siguiente pregunta
                          $bot_preguntas = DB::table('tb_bot_preguntas')
                                   ->where('ID_ENCUESTA', $job_encuesta_usuario->ID_ENCUESTA )
                                   ->where('ID_PREGUNTA', $siguiente->ID_PREGUNTA )->first();
                          
                          if($bot_preguntas != null){
                             $mensaje = $bot_preguntas->PREGUNTA;                    
                             $bot_preguntas_opciones_item = DB::table('tb_bot_preguntas_opciones')
                                                               ->where('ID_PREGUNTA',$siguiente->ID_PREGUNTA)
                                                               ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->get(); 
                             foreach ($bot_preguntas_opciones_item as $item) {
                                              $mensaje= $mensaje.PHP_EOL.$item->OPCION;
                                              if($item->OTRO==1){
                                                  //el sistema detecta que no hay opciones para esta pregunta
                                                   DB::table('tb_bot_temp_job_encuesta_usuario')
                                                        ->where('NUMERO',$numero )
                                                        ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )
                                                        ->update(array('STATUS_OTRO' => '1' ));
                                                  $mensaje=$mensaje.PHP_EOL.'Ingresar su respuesta en un solo mensaje';
                                              }
                             }
                             ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                          
                       }
                       }
                       else{
                          
                          $peso_total = DB::table('tb_bot_resultados_encuesta_opciones')->where("ID_ENCUESTA",$job_encuesta_usuario->ID_ENCUESTA)->sum("PESO");
                          
                          $res = "";
                          
                          if($peso_total == null){
                             $peso_total = 0;
                          }
                          
                          $rango = \App\BotCalculo::where("ID_ENCUESTA",$job_encuesta_usuario->ID_ENCUESTA)->whereRaw($peso_total." between MINIMO and MAXIMO")->orderBy("MINIMO","DESC")->orderBy("ID_RESULTADO","desc")->first();
                          
                          if($rango != null){
                             $res = $rango->MENSAJE;
                          }
                          else{
                             $rango = \App\BotCalculo::where("ID_ENCUESTA",$job_encuesta_usuario->ID_ENCUESTA)->where("OTROS",1)->orderBy("ID_RESULTADO","desc")->first();
                             
                             if($rango != null){
                                $res = $rango->MENSAJE;
                             }
                          }
                          
                          DB::table('tb_bot_resultados_encuesta_final')->insert(
                          [[ 'ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                             'CONDICION'=> 'repeticion',
                               'NUMERO' => $numero,
                               'RESPUESTA' => $res,
                               'PUNTAJE_RESULTADO' => $peso_total ,
                           ]]);
                           
                          if($rango != null){
                             
                             if($rango->IMG){
                                $mensaje = $rango->MENSAJE;
                                $url= $rango->URL_IMG;
                                ((new WhatsAppBot)->enviar_imagen_y_texto($cod_pais,$numero,$mensaje,$url,$APIurl,$token));
                                sleep(5);
                             }
                             else{
                                $mensaje = $rango->MENSAJE;
                                ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                             }
                             
                             
                          }
                          
                          //ultima pregunta ya no hay mas
                          DB::table('tb_bot_temp_job_encuesta_usuario')->where('NUMERO',$numero )->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )->update(array('STATUS_ULTIMA_RESPUESTA' => '1' ));
                          $ultimo_mensaje = DB::table('tb_bot_encuestas')->where("ID_ENCUESTA",$job_encuesta_usuario->ID_ENCUESTA)->first();
                          if($ultimo_mensaje->MSM_DESPEDIDA != ""){
                             
                             $mensaje=$ultimo_mensaje->MSM_DESPEDIDA; 
                             ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                             
                          }
                       }
                       
                    }
                 }
                 else{
                    
                    $mensaje="Pregunta ya no valida, pasando a siguiente pregunta"; 
                    ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                    
                    $siguiente = \App\Botpreguntas::where('ID_PREGUNTA',">",$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA)->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->orderBy("ID_PREGUNTA","asc")->first();
                    
                    if(isset($siguiente->ID_PREGUNTA)){
                       
                       
                       DB::table('tb_bot_temp_job_encuesta_usuario')->where('NUMERO',$numero )->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )->update(array('STATUS_ULTIMA_PREGUNTA' => $siguiente->ID_PREGUNTA ,'STATUS_OTRO' => '0' ));
                       //enviar siguiente pregunta
                       $bot_preguntas = DB::table('tb_bot_preguntas')
                                ->where('ID_ENCUESTA', $job_encuesta_usuario->ID_ENCUESTA )
                                ->where('ID_PREGUNTA', $siguiente->ID_PREGUNTA )->first();
                       
                       if($bot_preguntas != null){
                          $mensaje = $mensaje.''.$bot_preguntas->PREGUNTA;                    
                          $bot_preguntas_opciones_item = DB::table('tb_bot_preguntas_opciones')
                                                            ->where('ID_PREGUNTA',$siguiente->ID_PREGUNTA)
                                                            ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->get(); 
                          foreach ($bot_preguntas_opciones_item as $item) {
                                           $mensaje= $mensaje.PHP_EOL.$item->OPCION;
                                           if($item->OTRO==1){
                                               //el sistema detecta que no hay opciones para esta pregunta
                                                DB::table('tb_bot_temp_job_encuesta_usuario')
                                                     ->where('NUMERO',$numero )
                                                     ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )
                                                     ->update(array('STATUS_OTRO' => '1' ));
                                               $mensaje=$mensaje.PHP_EOL.'Ingresar su respuesta en un solo mensaje';
                                           }
                          }
                          ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                       
                       }
                    }
                    else{
                       
                       $peso_total = DB::table('tb_bot_resultados_encuesta_opciones')->where("ID_ENCUESTA",$job_encuesta_usuario->ID_ENCUESTA)->sum("PESO");
                          
                       $res = "";
                       
                       if($peso_total == null){
                          $peso_total = 0;
                       }
                       
                       $rango = \App\BotCalculo::where("ID_ENCUESTA",$job_encuesta_usuario->ID_ENCUESTA)->whereRaw($peso_total." between MINIMO and MAXIMO")->orderBy("MINIMO","DESC")->orderBy("ID_RESULTADO","desc")->first();
                       
                       if($rango != null){
                          $res = $rango->MENSAJE;
                       }
                       else{
                          $rango = \App\BotCalculo::where("ID_ENCUESTA",$job_encuesta_usuario->ID_ENCUESTA)->where("OTROS",1)->orderBy("ID_RESULTADO","desc")->first();
                          
                          if($rango != null){
                             $res = $rango->MENSAJE;
                          }
                       }
                       
                       DB::table('tb_bot_resultados_encuesta_final')->insert(
                       [[ 'ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                          'CONDICION'=> 'repeticion',
                            'NUMERO' => $numero,
                            'RESPUESTA' => $res,
                            'PUNTAJE_RESULTADO' => $peso_total ,
                        ]]);
                        
                       if($rango != null){
                          
                          if($rango->IMG){
                             $mensaje = $rango->MENSAJE;
                             $url= $rango->URL_IMG;
                             ((new WhatsAppBot)->enviar_imagen_y_texto($cod_pais,$numero,$mensaje,$url,$APIurl,$token));
                              sleep(5);
                          }
                          else{
                             $mensaje = $rango->MENSAJE;
                             ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                          }
                          
                         
                       }
                       
                       //ultima pregunta ya no hay mas
                       DB::table('tb_bot_temp_job_encuesta_usuario')->where('NUMERO',$numero )->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )->update(array('STATUS_ULTIMA_RESPUESTA' => '1' ));
                       $ultimo_mensaje = DB::table('tb_bot_encuestas')->where("ID_ENCUESTA",$job_encuesta_usuario->ID_ENCUESTA)->first();
                       if($ultimo_mensaje->MSM_DESPEDIDA != ""){
                          
                          $mensaje=$ultimo_mensaje->MSM_DESPEDIDA; 
                          ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));
                          
                       }

                    }
                 }
              }

            /*if(!(isset($job_encuesta_usuario->NUMERO))){//el numero no se encuesntra realizando encuesta BIENVENIDO
                   $bot_encuestas = DB::table('tb_bot_encuestas')
                         ->whereRaw('trim(lower(PALABRA_CLAVE)) = "'.trim(strtolower($message_item[0]->body)).'"')->first();
                         
                 
                   if(isset($bot_encuestas->ID_ENCUESTA)){
                       
                       
                       //new
                       $bot_preguntas = DB::table('tb_bot_resultados_encuesta_final')
                                         ->where('NUMERO',$numero )
                                         ->where('ID_ENCUESTA',$bot_encuestas->ID_ENCUESTA)->first();
                       if($bot_preguntas){
                           ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,"Estimado usuario usted ya participo en la encuesta" ,$APIurl,$token));
                       }else{
                           $mensaje = $bot_encuestas->MSM_BIENVENIDA.PHP_EOL.PHP_EOL;
                           $bot_preguntas = DB::table('tb_bot_preguntas')
                                             ->where('ID_ENCUESTA',$bot_encuestas->ID_ENCUESTA)->first();
                           
                           DB::table('tb_bot_temp_job_encuesta_usuario')->insert([
                                   ['NUMERO' => $numero , 
                                    'ID_ENCUESTA' => $bot_encuestas->ID_ENCUESTA,
                                    'STATUS_MENSAJE_BIENBENIDA' => '1',
                                    'STATUS_ULTIMA_PREGUNTA' => $bot_preguntas->ID_PREGUNTA  
                                  ]
                           ]);
                           
                           $mensaje= $mensaje.''.$bot_preguntas->PREGUNTA;                    
                           $bot_preguntas_opciones = DB::table('tb_bot_preguntas_opciones')
                                                 ->where('ID_PREGUNTA',$bot_preguntas->ID_PREGUNTA)
                                                 ->where('ID_ENCUESTA',$bot_encuestas->ID_ENCUESTA)->get(); 
                           foreach ($bot_preguntas_opciones as $item) {
                                  $mensaje= $mensaje.PHP_EOL.$item->OPCION;  
                                  if($item->OTRO==1){
                                       DB::table('tb_bot_temp_job_encuesta_usuario')
                                          ->where('NUMERO',$numero )
                                          ->where('ID_ENCUESTA',$bot_encuestas->ID_ENCUESTA )
                                          ->update(array('STATUS_OTRO' => '1' ));
                                       $mensaje=$mensaje.PHP_EOL.'Ingresar su respuesta en un solo mensaje';
                                 }
                           }
                           ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));  
                       }
                   }      
             }else{
                 if(isset($job_encuesta_usuario->NUMERO)){
                          $bot_pregunta_item = DB::table('tb_bot_preguntas')
                                         ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)
                                         ->where('ID_PREGUNTA',$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA )->first();
                          if (isset($bot_pregunta_item->ID_PREGUNTA)){  
                                 $siguiente = intval($bot_pregunta_item->ID_PREGUNTA) + 1;
                                 
                                 $mensaje="";
                                 //validar si respuesta requiere texto , si el texto es ingresado de manera manual y no es opcion almacenar sino elejir opcion
                                 //tb_bot_preguntas_opciones OTRO=0 no =1 si
                                 //INDICA AL SISTEMA ESPERA D EMENSAJE OTRO
                                 if( ($job_encuesta_usuario->STATUS_OTRO=='1') and ($job_encuesta_usuario->STATUS_ULTIMA_RESPUESTA=='0') 
                                         and (!((mb_strtolower($message_item[0]->body,'UTF-8')=='a')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='b')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='c')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='d')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='e')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='f')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='g')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='h')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='i')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='j'))) ){
                                    
                                         //bot_preguntas_opciones = DB::table('tb_bot_preguntas_opciones')
                                           //     ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)
                                             //   ->where('ID_PREGUNTA',$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA)->get(); 
                   
                                         //guardar respuesta
                                         DB::table('tb_bot_resultados_encuesta_opciones')->insert([
                                               ['ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                                                'ID_PREGUNTA'=> $job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA,
                                                'NUMERO' => $numero,
                                                'PREGUNTA' => $bot_pregunta_item->PREGUNTA ,
                                                'OPCION_CONTENIDO' => 'OTRO' ,
                                                'OPCION_ESCOJIDA' => mb_strtolower($message_item[0]->body,'UTF-8'),
                                                'PESO'=> '0'   ]
                                         ]);
                                         
                                         DB::table('tb_bot_temp_job_encuesta_usuario')
                                                                 ->where('NUMERO',$numero )
                                                                 ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )
                                                                 ->update(array('STATUS_ULTIMA_PREGUNTA' => $siguiente ,'STATUS_OTRO' => '0' ));
                                
                                         //enviar siguiente pregunta
                                         $bot_preguntas = DB::table('tb_bot_preguntas')
                                                  ->where('ID_ENCUESTA', $job_encuesta_usuario->ID_ENCUESTA )
                                                  ->where('ID_PREGUNTA', $siguiente )->first();
                                         
                                         if($bot_preguntas){
                                            $mensaje = $mensaje.''.$bot_preguntas->PREGUNTA;                    
                                            $bot_preguntas_opciones_item = DB::table('tb_bot_preguntas_opciones')
                                                                              ->where('ID_PREGUNTA',$siguiente)
                                                                              ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->get(); 
                                            foreach ($bot_preguntas_opciones_item as $item) {
                                                             $mensaje= $mensaje.PHP_EOL.$item->OPCION;
                                                             if($item->OTRO==1){
                                                                 //el sistema detecta que no hay opciones para esta pregunta
                                                                  DB::table('tb_bot_temp_job_encuesta_usuario')
                                                                       ->where('NUMERO',$numero )
                                                                       ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )
                                                                       ->update(array('STATUS_OTRO' => '1' ));
                                                                 $mensaje=$mensaje.PHP_EOL.'Ingresar su respuesta en un solo mensaje';
                                                             }
                                            }
                                            ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$siguiente.','.$mensaje ,$APIurl,$token));  
                                         }else{
                                            //ultima pregunta ya no hay mas
                                            DB::table('tb_bot_temp_job_encuesta_usuario')
                                                ->where('NUMERO',$numero )
                                                ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )
                                                ->update(array('STATUS_ULTIMA_RESPUESTA' => '1' ));
                                         }
                                 }else if(($job_encuesta_usuario->STATUS_ULTIMA_RESPUESTA=='0')){
                                        
                                       if(     (mb_strtolower($message_item[0]->body,'UTF-8')=='a')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='b')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='c')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='d')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='e')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='f')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='g')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='h')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='i')
                                            or (mb_strtolower($message_item[0]->body,'UTF-8')=='j') ){
                                                
                                               $temp_op="";
                                               switch(mb_strtolower($message_item[0]->body,'UTF-8')){
                                                 case 'a': { $temp_op='a'; break; }
                                                 case 'b': { $temp_op='b'; break; }
                                                 case 'c': { $temp_op='c'; break; }
                                                 case 'd': { $temp_op='d'; break; }
                                                 case 'e': { $temp_op='e'; break; }
                                                 case 'f': { $temp_op='f'; break; }
                                                 case 'g': { $temp_op='g'; break; }
                                                 case 'h': { $temp_op='h'; break; }
                                                 case 'i': { $temp_op='i'; break; }
                                                 case 'j': { $temp_op='j'; break; }
                                                 default:  { 
                                                     break;
                                               }}
                                               
                                               //evaluar caso a
                                                         $bot_preguntas_opciones = DB::table('tb_bot_preguntas_opciones')
                                                               ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)
                                                               ->where('ID_PREGUNTA',$job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA)
                                                               ->where('CLAVE',$temp_op)->first(); 
                                                               
                                                        if($bot_preguntas_opciones){
                                                           
                                                            DB::table('tb_bot_temp_job_encuesta_usuario')
                                                                      ->where('NUMERO',$numero )
                                                                      ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )
                                                                      ->update(array('STATUS_ULTIMA_PREGUNTA' => $siguiente ));
                                                                      
                                                            //guardar respuesta
                                                            DB::table('tb_bot_resultados_encuesta_opciones')->insert([
                                                                    ['ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                                                                     'ID_PREGUNTA'=> $job_encuesta_usuario->STATUS_ULTIMA_PREGUNTA,
                                                                     'NUMERO' => $numero,
                                                                     'PREGUNTA' => $bot_pregunta_item->PREGUNTA ,
                                                                     'OPCION_CONTENIDO' => $bot_preguntas_opciones->OPCION ,
                                                                     'OPCION_ESCOJIDA' => $temp_op,
                                                                     'PESO'=> $bot_preguntas_opciones->PESO   ]
                                                            ]);
                                                         
                                                           if($bot_preguntas_opciones->AUTO_RESPUESTA=='1'){
                                                              ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$bot_preguntas_opciones->RESPUESTA ,$APIurl,$token)); 
                                                           }
                                                         
                                                            //enviar pregunta suguiente
                                                            $bot_preguntas = DB::table('tb_bot_preguntas')
                                                              ->where('ID_ENCUESTA', $job_encuesta_usuario->ID_ENCUESTA )
                                                              ->where('ID_PREGUNTA', $siguiente )->first();
                                                            if($bot_preguntas){
                                                                $mensaje = $mensaje.''.$bot_preguntas->PREGUNTA;                    
                                                                $bot_preguntas_opciones_item = DB::table('tb_bot_preguntas_opciones')
                                                                                                  ->where('ID_PREGUNTA',$siguiente)
                                                                                                  ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)->get(); 
                                                                $switch_img=false;
                                                                foreach ($bot_preguntas_opciones_item as $item) {
                                                                                 
                                                                                 if($item->IMG==1){
                                                                                    if($switch_img==false){  ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$siguiente.','.$mensaje ,$APIurl,$token));  }
                                                                                    $switch_img=true;
                                                                                    $parametro="";
                                                                                    if($temp_op=='a'){$parametro='hombre';}
                                                                                    if($temp_op=='b'){$parametro='mujer';}
                                                                                    if($temp_op=='c'){$parametro='ambos';}
                                                                                    $url= str_replace("%parameter%", $parametro,  $item->URL_IMAGEN );
                                                                                    ((new WhatsAppBot)->enviar_imagen_y_texto($cod_pais,$numero,$item->OPCION,$url,$APIurl,$token));
                                                                                 }else{
                                                                                    $mensaje= $mensaje.PHP_EOL.$item->OPCION;
                                                                                    if($item->OTRO==1){
                                                                                        //el sistema detepta que no hay opciones para esta pregunta
                                                                                         DB::table('tb_bot_temp_job_encuesta_usuario')
                                                                                              ->where('NUMERO',$numero )
                                                                                              ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )
                                                                                              ->update(array('STATUS_OTRO' => '1' ));
                                                                                        $mensaje=$mensaje.PHP_EOL.'Ingresar su respuesta en un solo mensaje';
                                                                                    }
                                                                                 }
                                                                }
                                                                if($switch_img==false){
                                                                    ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$siguiente.','.$mensaje ,$APIurl,$token)); 
                                                                }
                                                             }else{
                                                                //ultima pregunta ya no hay mas
                                                                DB::table('tb_bot_temp_job_encuesta_usuario')
                                                                    ->where('NUMERO',$numero )
                                                                    ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )
                                                                    ->update(array('STATUS_ULTIMA_RESPUESTA' => '1' ));
                                                             }
                                                           
                                                        }else{
                                                           $mensaje="Estimado por favor digitar una opción correcta, solo digite la letra correspondiente ejemplo:  a  "; 
                                                           ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token)); 
                                                           
                                                        }

                                                         
                                                        
                                               
                                       
                                       }else{
                                           $mensaje="Estimado por favor digitar una opción correcta, solo digite la letra correspondiente ejemplo:  a  "; 
                                           ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$mensaje ,$APIurl,$token));  
                                       }
                                           
                                 }
                          }
                          
                          
                          $job_encuesta_usuario= DB::table('tb_bot_temp_job_encuesta_usuario')
                                                 ->where('NUMERO',$numero)->first();
                          
                          
                          if($job_encuesta_usuario->STATUS_ULTIMA_RESPUESTA=='1'){
                                 //calcular puntaje
                                 //calcular scor
                                      //tb_bot_resultados_encuesta_final guardar
                                       $list_resultados_encuesta_opciones= DB::table('tb_bot_resultados_encuesta_opciones')
                                         ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA)
                                         ->where('NUMERO',$numero)->get();
                                         
                                       if($job_encuesta_usuario->ID_ENCUESTA==3){
                                          $a=0;$b=0; $c=0;$d=0;$e=0;$f=0;
                                          foreach ($list_resultados_encuesta_opciones as $op) {
                                             if ($op->OPCION_ESCOJIDA=='a'){$a++;}
                                             if ($op->OPCION_ESCOJIDA=='b'){$b++;}
                                             if ($op->OPCION_ESCOJIDA=='c'){$c++;}
                                             if ($op->OPCION_ESCOJIDA=='d'){$d++;}
                                             if ($op->OPCION_ESCOJIDA=='e'){$e++;}
                                             if ($op->OPCION_ESCOJIDA=='f'){$f++;}
                                          } 
                                          $res="";
                                          $imagen = "";
                                          if($a >= $b and $a>= $c and $a>= $d and $a>=$e and $a>=$f ){
                                              $res="Mayoría de a: Tu color es el Azul. ¡Felicitaciones! Estás atravesando está cuarentena intentando mantener la paz, tranquilidad y armonía.";
                                              $imagen = "https://epidemiasperu.com/bot_img/salud_mental/a2.png";
                                          }else if($b >= $a and $b>= $c and $b>= $d and $b>=$e and $b>=$f){
                                              $res="Mayoría de b: Tu color es el Amarillo. A pesar de estar en un momento complicado, tu mantienes el optimismo y lo contagias a los demás, ¡sigue así!.";
                                              $imagen = "https://epidemiasperu.com/bot_img/salud_mental/b2.png";
                                              
                                          }else if($c >= $b and $c>= $a and $c>= $d and $c>=$e and $c>=$f){
                                              $res="Mayoría de c: Tu color es el Morado. En esta cuarentena te estás llenando de emociones como la rabia y la agresividad. Te recomendamos pensar en cómo te sientes y el porqué te estas sintiendo así. Es importante que converses de tus sentimientos con familiares y amigos y estar abierto a escuchar sus consejos.";
                                              $imagen = "https://epidemiasperu.com/bot_img/salud_mental/c2.png";
                                              
                                          }else if($d >= $b and $d>= $c and $d>= $a and $d>=$e and $d>=$f){
                                              $res="Mayoría de d: Tu color es el Plomo. Este tiempo de cuarentena deja en ti una sensación de tristeza, pérdida y desilusión que no son buenos para tu salud mental. Te recomendamos conversar sobre ello con tus familiares y amigos. Asimismo, hacer deporte en casa e intentar dormir tus 8 horas diarias.";
                                              $imagen = "https://epidemiasperu.com/bot_img/salud_mental/d2.png";
                                              
                                          }else if($e >= $b and $e>= $c and $e>= $d and $e>=$a and $e>=$f){
                                              $res="Mayoría de e: Tu color es el Gris Oscuro. Si bien todo es nuevo y no sabemos bien a qué nos estamos enfrentando o cómo será la “nueva normalidad”, no debemos dejarnos ganar por el miedo. Te recomendamos descansar lo suficiente, hacer ejercicio en casa y organizar tus horarios para lograr vencer la parálisis en la que nos suele sumergir el miedo. ¡Tú puedes!";
                                              $imagen = "https://epidemiasperu.com/bot_img/salud_mental/e2.png";
                                              
                                          }else if($f >= $b and $f>= $c and $f>= $d and $f>=$e and $f>=$a){
                                              $res="Mayoría de f: Tu color es el rosado. ¡A buena hora! Estás pasando esta cuarentena rodeado de alegría y con mucho cariño. Aprovecha ese vínculo con tus más cercanos para seguir reforzando esta emoción.";
                                              $imagen = "https://epidemiasperu.com/bot_img/salud_mental/f2.png";
                                              
                                          }else{
                                              $res="Mayoría de a: Tu color es el Azul. ¡Felicitaciones! Estás atravesando está cuarentena intentando mantener la paz, tranquilidad y armonía.
                                                    Mayoría de b: Tu color es el Amarillo. A pesar de estar en un momento complicado, tu mantienes el optimismo y lo contagias a los demás, ¡sigue así!.
                                                    Mayoría de c: Tu color es el Morado. En esta cuarentena te estás llenando de emociones como la rabia y la agresividad. Te recomendamos pensar en cómo te sientes y el porqué te estas sintiendo así. Es importante que converses de tus sentimientos con familiares y amigos y estar abierto a escuchar sus consejos.
                                                    Mayoría de d: Tu color es el Plomo. Este tiempo de cuarentena deja en ti una sensación de tristeza, pérdida y desilusión que no son buenos para tu salud mental. Te recomendamos conversar sobre ello con tus familiares y amigos. Asimismo, hacer deporte en casa e intentar dormir tus 8 horas diarias.
                                                    Mayoría de e: Tu color es el Gris Oscuro. Si bien todo es nuevo y no sabemos bien a qué nos estamos enfrentando o cómo será la “nueva normalidad”, no debemos dejarnos ganar por el miedo. Te recomendamos descansar lo suficiente, hacer ejercicio en casa y organizar tus horarios para lograr vencer la parálisis en la que nos suele sumergir el miedo. ¡Tú puedes!
                                                    Mayoría de f: Tu color es el rosado. ¡A buena hora! Estás pasando esta cuarentena rodeado de alegría y con mucho cariño. Aprovecha ese vínculo con tus más cercanos para seguir reforzando esta emoción.";
                                          }
                                          
                                          //despedida
                                          $bot_encuestas = DB::table('tb_bot_encuestas')
                                                           ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )->first();
                                          //((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$bot_encuestas->MSM_DESPEDIDA ,$APIurl,$token)); 
                                          $res=$res.''.PHP_EOL.$bot_encuestas->MSM_DESPEDIDA;
                                          if($imagen==""){
                                              ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$res ,$APIurl,$token));
                                          }else {
                                              ((new WhatsAppBot)->enviar_imagen_y_texto($cod_pais,$numero,$res,$imagen,$APIurl,$token));
                                          }
                                       
                                          DB::table('tb_bot_resultados_encuesta_final')->insert([
                                                                     ['ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                                                                      'CONDICION'=> 'repeticion',
                                                                      'NUMERO' => $numero,
                                                                      'RESPUESTA' => $res,
                                                                      'PUNTAJE_RESULTADO' => '' ,
                                                                      ]
                                                             ]);
                                          
                                       }
                                       
                                       if($job_encuesta_usuario->ID_ENCUESTA==1 or $job_encuesta_usuario->ID_ENCUESTA==4 or $job_encuesta_usuario->ID_ENCUESTA==5){
                                           
                                           //despedida
                                         $bot_encuestas = DB::table('tb_bot_encuestas')
                                                           ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )->first();
                                         ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$bot_encuestas->MSM_DESPEDIDA ,$APIurl,$token));
                                         DB::table('tb_bot_resultados_encuesta_final')->insert([
                                                                     ['ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                                                                      'CONDICION'=> 'libre',
                                                                      'NUMERO' => $numero,
                                                                      'RESPUESTA' => '',
                                                                      'PUNTAJE_RESULTADO' => '' ,
                                                                      ]
                                                             ]);
                                           
                                       }
                                       
                                       if($job_encuesta_usuario->ID_ENCUESTA==2){
                                           
                                           //despedida
                                           
                                         $res="Reflexión final".PHP_EOL.
                                              "Recuerda que no necesitas a alguien para estar completo, tu ya eres una persona completa y no necesitas a nadie para ser feliz. Una pareja no te completa sino que te acompaña en el proceso de crecer y ser mejor persona. ".PHP_EOL.
                                               "Servicios".PHP_EOL.
                                               "Si eres parte de una   relación violenta o conoces a alguien que lo sea, estos son algunos espacios en los que pueden ayudarte:".PHP_EOL.
                                               "chat 100 (www.mimp.gob.pe/chat100),pueden ayudarte a identificar situaciones de riesgo en tu relación y darte muy buenos consejos.".PHP_EOL.
                                               "Centro de Emergencia Mujer: puedesir a hablar sobre cómo te sientes o a denunciar un caso de violencia".PHP_EOL.
                                               "Llamando a la línea 100, sólo  marca en tu teléfono el número 100, ¡atiende las 24h!, ellos pueden derivarte para una atención especializada y tomar la denuncia del caso.";
                                         
                                         ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero , $res ,$APIurl,$token));
                                         
                                         
                                         $bot_encuestas = DB::table('tb_bot_encuestas')
                                                           ->where('ID_ENCUESTA',$job_encuesta_usuario->ID_ENCUESTA )->first();
                                         ((new WhatsAppBot)->enviar_mensaje_regular($cod_pais, $numero ,$bot_encuestas->MSM_DESPEDIDA ,$APIurl,$token));
                                         DB::table('tb_bot_resultados_encuesta_final')->insert([
                                                                     ['ID_ENCUESTA' => $job_encuesta_usuario->ID_ENCUESTA ,
                                                                      'CONDICION'=> 'libre',
                                                                      'NUMERO' => $numero,
                                                                      'RESPUESTA' => '',
                                                                      'PUNTAJE_RESULTADO' => '' ,
                                                                      ]
                                                             ]);
                                           
                                       }
                                       
                                       
                                          
                                       //tb_bot_resultados_encuesta_final
                                       
                                       DB::table('tb_bot_temp_job_encuesta_usuario')->where('NUMERO', $numero)->delete(); 
                          }
                          
                 }
             }      
           
             
          }
       }*/
             
          
   }
   
   public function test(Request $request){
       
       //test
       
      $WhatsAppBot = new WhatsAppBot(); 
      $mensaje = '.prueba';
      //$APIurl =  'https://eu47.chat-api.com/instance139591/';
      //$token  =  '5qzsfqhpihfr8rze';
      //$APIurl =  'https://eu2.chat-api.com/instance147561/';
      //$token  =  'xslyno2u80x7ejax';
      
      // $WhatsAppBot->enviar_mensaje_regular ('51','954137162',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','924854294',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','912279991',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','969856427',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','918651020',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','973740454',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','991920010',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','900670967',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','939997066',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','935088132',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','999289219',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','917123890',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','984346783',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','925850925',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','925031580',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','921057136',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','918651020',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','973740454',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','900779662',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','900189041',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','955321905',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','910734295',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','927854504',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','918646387',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','921449890',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','959666096',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','927281982',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','927579281',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','928195422',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','929318279',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','929743787',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','932594469',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','928268528',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','979633108',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','995946656',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','914442670',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','936941535',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','992330690',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','902614873',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','955826366',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','930936951',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','900476925',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','930376967',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','956472376',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','947395528',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','932819711',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','962498813',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','926016314',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','910391092',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','924453913',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','920823043',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','929176067',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','964733877',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','971373014',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','916426753',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','916983075',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','924854294',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','920256422',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','927788052',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','981406256',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','918389705',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','930234312',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','916298958',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','917723185',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','980275950',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','948840490',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','931217185',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','947327261',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','928187003',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','902314330',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','912090971',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','941249054',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','967182821',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','931279577',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','921142859',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','928065012',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','990398033',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','972816187',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','922930379',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','972053294',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','976179489',$mensaje,$APIurl,$token);
      // $WhatsAppBot->enviar_mensaje_regular ('51','977146506',$mensaje,$APIurl,$token);
      
      $instancia = Config_wassap::find(2);
      $APIurl = $instancia->URL;
      $token = $instancia->API_KEY;
      
      
      $WhatsAppBot->enviar_video_y_texto ('51','977146506',$mensaje,'https://restocombo.com/BOT_WHATSAPP/MiConnect/public/storage/video/l8hJ4BlBxX.mp4',$APIurl,$token);

      return 'ok';
       
       
       
   }
   
   
   
   public function Read_messages_recibidos(Request $request){
       
       $page = 1;
       //$mensajes_recibidos = mensajes_pruebas::orderBy('id', 'desc')->paginate(15,['*'], 'page', $page)->where('fromMe', 0);
       $mensajes_recibidos = mensajes_pruebas::orderBy('id', 'desc')->where(function ($query) {
                            $query->where('numero', 'like', "%%")
                                  ->orwhere('numdestino', 'like', "%%");
                            })->orderBy('id', 'desc')->paginate(15);

        if ($request->ajax()) {
            
            if($request->get("texto")=="--"){
                switch ($request->get("tipo")) {
                    
                    case 0:
                        $mensajes_recibidos = mensajes_pruebas::orderBy('id', 'desc')->where(function ($query) {
                                $query->where('numero', 'like', "%%")
                                      ->orwhere('numdestino', 'like', "%%");
                                })->orderBy('id', 'desc')->paginate(15);
                        break;
                    case 1:
                        $mensajes_recibidos = mensajes_pruebas::where("fromMe","=","1")->where(function ($query) {
                                $query->where('numero', 'like', "%%")
                                      ->orwhere('numdestino', 'like', "%%");
                                })->orderBy('id', 'desc')->paginate(15);
                        break;
                    case 2:
                        $mensajes_recibidos = mensajes_pruebas::where("fromMe","=","0")->where(function ($query) {
                                $query->where('numero', 'like', "%%")
                                      ->orwhere('numdestino', 'like',"%%");
                                })->orderBy('id', 'desc')->paginate(15);
                        break;
                }
            }
            else{
                if($request->get("texto")=="%%"){
                   switch ($request->get("tipo")) {
                    
                    case 0:
                        $mensajes_recibidos = mensajes_pruebas::orderBy('id', 'desc')->where(function ($query)  {
                                $query->where('numero', 'like', "%%")
                                      ->orwhere('numdestino', 'like', "%%");
                                })->orderBy('id', 'desc')->paginate(15);
                        break;
                    case 1:
                        $mensajes_recibidos = mensajes_pruebas::where("fromMe","=","1")->where(function ($query) {
                                $query->where('numero', 'like', "%%")
                                      ->orwhere('numdestino', 'like', "%%");
                                })->orderBy('id', 'desc')->paginate(15);
                        break;
                    case 2:
                        $mensajes_recibidos = mensajes_pruebas::where("fromMe","=","0")->where(function ($query) {
                                $query->where('numero', 'like', "%%")
                                      ->orwhere('numdestino', 'like',"%%");
                                })->orderBy('id', 'desc')->paginate(15);
                        break;
                    }
                }
                else{
                    if($request->get("tipo_t")=="1"){
                        $b = $request->get("texto");
                        switch ($request->get("tipo")) {
                    
                        case 0:
                            $mensajes_recibidos = mensajes_pruebas::orderBy('id', 'desc')->where(function ($query) use ($b) {
                                    $query->where('numero', 'like', "%". $b ."%")
                                          ->orwhere('numdestino', 'like',"%".$b."%");
                                    })->orderBy('id', 'desc')->paginate(15);
                            break;
                        case 1:
                            $mensajes_recibidos = mensajes_pruebas::where("fromMe","=","1")->where(function ($query) use ($b){
                                    $query->where('numero', 'like', "%".$b."%")
                                          ->orwhere('numdestino', 'like',"%".$b."%");
                                    })->orderBy('id', 'desc')->paginate(15);
                            break;
                        case 2:
                            $mensajes_recibidos = mensajes_pruebas::where("fromMe","=","0")->where(function ($query) use ($b) {
                                    $query->where('numero', 'like',"%".$b."%")
                                          ->orwhere('numdestino', 'like',"%".$b."%");
                                    })->orderBy('id', 'desc')->paginate(15);
                            break;
                        }  
                    }
                    else if($request->get("tipo_t")=="2") {
                        $b = $request->get("texto");
                        switch ($request->get("tipo")) {
                            case 0:
                                $mensajes_recibidos = mensajes_pruebas::orderBy('id', 'desc')->where(function ($query) use ($b){
                                        $query->where('nombrechat', 'like',"%".$b."%");
                                        })->orderBy('id', 'desc')->paginate(15);
                                break;
                            case 1:
                                $mensajes_recibidos = mensajes_pruebas::where("fromMe","=","1")->where(function ($query) use ($b){
                                        $query->where('nombrechat', 'like',"%".$b."%");
                                        })->orderBy('id', 'desc')->paginate(15);
                                break;
                            case 2:
                                $mensajes_recibidos = mensajes_pruebas::where("fromMe","=","0")->where(function ($query) use ($b) {
                                        $query->where('nombrechat', 'like',"%".$b."%");
                                        })->orderBy('id', 'desc')->paginate(15);
                                break;
                        }  
                    }
                }
            }
            
            
            return view('tabla_view', ['mensajes_recibidos' => $mensajes_recibidos])->render();  
 
        }
       
       return view('Mensajes',['mensajes_recibidos' => $mensajes_recibidos]); 
       
   }
}
