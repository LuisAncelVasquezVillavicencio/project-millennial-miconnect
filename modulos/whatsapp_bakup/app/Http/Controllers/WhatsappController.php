<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use App\Empresa;
use Illuminate\Support\Facades\Http;


class WhatsappController extends Controller
{
    
    
    //https://developers.facebook.com/docs/whatsapp/cloud-api/guides/send-messages
    public function crear(Request $request)
    {
        /* $campos=[
            "CATEGORIA"=>["required","max:255"],
        ];
        $reglas=[
            "CATEGORIA.required"=>"Este campo es requerido",
            "CATEGORIA.max"=>"Caracteres máximos: 255",
        ];
        
        $validator = \Validator::make($request->all(), $campos,$reglas);*/
        //$error = $validator->errors()->toArray();
        
        /*if($error){
            return response()->json(["errors"=>$error]);
        }*/
       
        $x = new Empresa();
        $x->empresa_nombre = $request->get("empresa_nombre");
        $x->empresa_ruc = $request->get("empresa_ruc");
        $x->empresa_pagina_oficial = $request->get("empresa_pagina_oficial");
        $x->empresa_url_logo = $request->get("empresa_url_logo");
        $x->empresa_correo = $request->get("empresa_correo");
        $x->empresa_telefono = $request->get("empresa_telefono");
        $x->empresa_descripcion = $request->get("empresa_descripcion");
        $x->empresa_direccion = $request->get("empresa_direccion");
        $x->empresa_gps_latitud = $request->get("empresa_gps_latitud");
        $x->empresa_gps_longitud = $request->get("empresa_gps_longitud");
        $x->estado = $request->get("estado");
        
        if($x->save()){ return json_encode(["data"=>$x->toArray(),'resultado'=>"true" ]); }
        else{ return json_encode(['resultado'=>"error",'mensaje'=>"Ocurrio un error, vuelva a cargar la página"]); }
        
    }
    
    /*created : Jesus Salgado*/
    /*
        Metodos de envio:
        $n_pais : Numero prefijo de pais
        $numero : Numero de teléfono
        $mensaje: 
    */ 
    function sendTextMessages(Request $request){
        
        //Identificador de número de teléfono
        $idNumTel = $request->idNumTel;//109949925143071
        $to = $request->to;//51941695131
        $recipient_type = $request->recipient_type;//individual
        $preview_url = $request->preview_url;// "false"; //si hay https
        $body = $request->body;// "false"; //si hay https
        $token = $request->token; // Bearer EAAPmKaDlIbEBAGuIu2KtIeX2MoWsS2P6THLmjixBZA8OmvdQqF989hKdRO9ZCTMVMk0acZAJT8nIUZC769T4uGyBO1ORR0Hj6Y6JLoZACVGIvM8PAehPwnycdY4m1yOSiq7MpsKhgpjpFyHEIOgHEYZAOZBjuSReDaJe5TDmyeAVvJT6nwupyH2ti8fmTSc7vvXmBSZCksMvGL1tIzTAg8KW
        
        $messaging_product = "whatsapp";//whatsapp
        $type = "text";//51941695131
        
        $apiURL = env('GRAPH_FACEBOOK').$idNumTel.'/messages';
        
        $postInput = [
                'messaging_product' => "whatsapp", 
                "recipient_type"  => $recipient_type,
                'to' => $to,
                'type' => $type,
                 $type => [ 'preview_url' => $preview_url, 'body' => $body ],
        ];
        
        
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $token
        ];
        
        $response = Http::withHeaders($headers)->post($apiURL,$postInput);
        
        
        $statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);
        
        return json_encode(["data"=>$responseBody,'resultado'=>"true" ]);
        
    }
    /*{
      "messaging_product": "whatsapp",
      "contacts": [{
          "input": "PHONE_NUMBER",
          "wa_id": "WHATSAPP_ID",
        }]
      "messages": [{
          "id": "wamid.ID",
        }]
    }*/
    
    function sendMediaMessages(Request $request){
        //Identificador de número de teléfono
        $idNumTel = $request->idNumTel;//109949925143071
        $to = $request->to;//51941695131
        $recipient_type = $request->recipient_type;//individual
        $preview_url = $request->preview_url;// "false"; //si hay https
        $body = $request->body;// "false"; //si hay https
        $token = $request->token; // Bearer EAAPmKaDlIbEBAGuIu2KtIeX2MoWsS2P6THLmjixBZA8OmvdQqF989hKdRO9ZCTMVMk0acZAJT8nIUZC769T4uGyBO1ORR0Hj6Y6JLoZACVGIvM8PAehPwnycdY4m1yOSiq7MpsKhgpjpFyHEIOgHEYZAOZBjuSReDaJe5TDmyeAVvJT6nwupyH2ti8fmTSc7vvXmBSZCksMvGL1tIzTAg8KW
        
        $messaging_product = "whatsapp";//whatsapp
        $type = $request->type ; //= "image"; image, document, audio, image, video, or sticker
        
        $apiURL = env('GRAPH_FACEBOOK').$idNumTel.'/messages';
        
        $type_id = $request->id ;
        $type_link= $request->url ;
        $type_caption= $request->caption ;
        $type_filename= $request->filename ;
        
        $type_obj = array();
        $type_obj = isset($request->id) ? array_merge($type_obj,array('id' => $type_id))  : $type_obj ;
        $type_obj = isset($request->url) ? array_merge($type_obj,array('link' => $type_link))  : $type_obj ;
        $type_obj = isset($request->caption) ? array_merge($type_obj,array('caption' => $type_link))  : $type_obj ;
        $type_obj = isset($request->filename) ? array_merge($type_obj,array('filename' => $type_link))  : $type_obj ;
            
        $postInput = [
                'messaging_product' => "whatsapp", 
                "recipient_type"  => $recipient_type,
                'to' => $to,
                'type' => $type,
                $type => $type_obj ,
        ];
        
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $token
        ];
        
        $response = Http::withHeaders($headers)->post($apiURL,$postInput);
        
        
        $statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);
        
        return json_encode(["data"=>$responseBody,'resultado'=>"true" ]);
        
    }
    
    //https://developers.facebook.com/docs/whatsapp/cloud-api/reference/messages#media-object
    
   
    function sendLocationMessages(Request $request){
        
        //Identificador de número de teléfono
        $idNumTel = $request->idNumTel;//109949925143071
        $to = $request->to;//51941695131
        $recipient_type = $request->recipient_type;//individual
        $preview_url = $request->preview_url;// "false"; //si hay https
        $body = $request->body;// "false"; //si hay https
        $token = $request->token; // Bearer EAAPmKaDlIbEBAGuIu2KtIeX2MoWsS2P6THLmjixBZA8OmvdQqF989hKdRO9ZCTMVMk0acZAJT8nIUZC769T4uGyBO1ORR0Hj6Y6JLoZACVGIvM8PAehPwnycdY4m1yOSiq7MpsKhgpjpFyHEIOgHEYZAOZBjuSReDaJe5TDmyeAVvJT6nwupyH2ti8fmTSc7vvXmBSZCksMvGL1tIzTAg8KW
        
        $messaging_product = "whatsapp";//whatsapp
        $type = "location";//51941695131
        
        $apiURL = env('GRAPH_FACEBOOK').$idNumTel.'/messages';
        
        $postInput = [
                'messaging_product' => "whatsapp", 
                "recipient_type"  => $recipient_type,
                'to' => $to,
                'type' => $type,
                 $type => [ 'longitude' => $request->longitude, 'latitude' => $request->latitude , 'name' => $request->name , 'address' => $request->address ],
        ];
        
        
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $token
        ];
        
        $response = Http::withHeaders($headers)->post($apiURL,$postInput);
        
        
        $statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);
        
        return json_encode(["data"=>$responseBody,'resultado'=>"true" ]);
     
       
    }
      /*longitude

Requerido.

Longitud de la ubicación.

latitude

Requerido.

Latitud de la ubicación.

name

Opcional.

Nombre de la ubicación.

address

Opcional.

Dirección de la ubicación. Solo se muestra si nameestá presente.*/

    
    function sendContactMessages(Request $request){
        /*curl -X  POST \
         'https://graph.facebook.com/v13.0/FROM_PHONE_NUMBER_ID/messages' \
         -H 'Authorization: ACCESS_TOKEN' \
         -d '{
          "messaging_product": "whatsapp",
          "to": "PHONE_NUMBER",
          "type": "contacts",
          "contacts": [{
              "addresses": [{
                  "street": "STREET",
                  "city": "CITY",
                  "state": "STATE",
                  "zip": "ZIP",
                  "country": "COUNTRY",
                  "country_code": "COUNTRY_CODE",
                  "type": "HOME"
                },
                {
                  "street": "STREET",
                  "city": "CITY",
                  "state": "STATE",
                  "zip": "ZIP",
                  "country": "COUNTRY",
                  "country_code": "COUNTRY_CODE",
                  "type": "WORK"
                }],
              "birthday": "YEAR_MONTH_DAY",
              "emails": [{
                  "email": "EMAIL",
                  "type": "WORK"
                },
                {
                  "email": "EMAIL",
                  "type": "HOME"
                }],
              "name": {
                "formatted_name": "NAME",
                "first_name": "FIRST_NAME",
                "last_name": "LAST_NAME",
                "middle_name": "MIDDLE_NAME",
                "suffix": "SUFFIX",
                "prefix": "PREFIX"
              },
              "org": {
                "company": "COMPANY",
                "department": "DEPARTMENT",
                "title": "TITLE"
              },
              "phones": [{
                  "phone": "PHONE_NUMBER",
                  "type": "HOME"
                },
                {
                  "phone": "PHONE_NUMBER",
                  "type": "WORK",
                  "wa_id": "PHONE_OR_WA_ID"
                }],
              "urls": [{
                  "url": "URL",
                  "type": "WORK"
                },
                {
                  "url": "URL",
                  "type": "HOME"
                }]
            }]
        }'*/
        
    }
    
    
    function sendInteractiveMessages(Request $request){
        
    }
    
    
    function sendTextMessagesTemplate(Request $request){
        //Identificador de número de teléfono
        $idNumTel = $request->idNumTel;//109949925143071
        $to = $request->to;//51941695131
        $recipient_type = $request->recipient_type;//individual
        $preview_url = $request->preview_url;// "false"; //si hay https
        $body = $request->body;// "false"; //si hay https
        $token = $request->token; // Bearer EAAPmKaDlIbEBAGuIu2KtIeX2MoWsS2P6THLmjixBZA8OmvdQqF989hKdRO9ZCTMVMk0acZAJT8nIUZC769T4uGyBO1ORR0Hj6Y6JLoZACVGIvM8PAehPwnycdY4m1yOSiq7MpsKhgpjpFyHEIOgHEYZAOZBjuSReDaJe5TDmyeAVvJT6nwupyH2ti8fmTSc7vvXmBSZCksMvGL1tIzTAg8KW
        
        
        $messaging_product = "whatsapp";//whatsapp
        $type = "template";//51941695131
        
        $apiURL = env('GRAPH_FACEBOOK').$idNumTel.'/messages';
        
        $postInput = [
                'messaging_product' => "whatsapp", 
                "recipient_type"  => $recipient_type,
                'to' => $to,
                'type' => $type,
                 $type => [ 'name' => 'hello_world',
                            'language' => [ 'code' => 'en_US' ] ,
                            /*'components' => [[
                              'type' => 'body' ,
                              'parameters' => [
                                [ 'type' => 'text' , 'text' => 'text-string' ]
                                //[ 'type' => 'currency' , 'currency' => [ 'fallback_value' => 'VALUE' ,'code' => 'USD' ,'amount_1000' => 'NUMBER'  ] ],
                                //[ 'type' => 'date_time' , 'date_time' => [ 'fallback_value' => 'DATE' ] ]
                              ]
                            ]] */
                          ]
        ];
        
        //return  $postInput;
        
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $token
        ];
        
        $response = Http::withHeaders($headers)->post($apiURL,$postInput);
        
        
        $statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);
        
        return json_encode(["data"=>$responseBody,'resultado'=>"true" ]);
    }
  
    
    /*curl -X POST "https://graph.facebook.com/v14.0/{whatsapp-business-account-ID}/message_templates
  ?name={template-name}
  &language=en_US
  &category=TRANSACTIONAL,
  &components=[{
       type:BODY, 
       text:{message-text}
     }, 
     {
       type:HEADER, 
       format:IMAGE, 
       example:{header_handle:[{uploaded-image-file-url}]}
     }],
  */
  
   
    public function crearMessagesTemplateMultimedia(Request $request)
    {
       
       $whatsappBusinessAccountID = $request->whatsappBusinessAccountID;//101573755994797
       $userAccessToken = $request->userAccessToken; //EAAPmKaDlIbEBAPFLZC4tyq6e2hb3p0yjEyzZChcZAeZBHHfjlvwtGpt2pMZC3YUumI1sGFeoAvgZA8JfZBMMgpqcZAnKpF7sRQwSMF9FeqYUjUmnsHfyhcob5hne9HbZBgNN9XYo8VZAvrwmEvJ7tALisZCB6wZB3Q20ZBzZBis3ilhEjjquvHmxR4XHkCYj4zuUGSF5lwA3zxHUcxWZBdEjuDlZBS9R
       
       $templateName=$request->templateName;
       $language= $request->language; //https://developers.facebook.com/docs/whatsapp/api/messages/message-templates#language
       $category= $request->category; //TRANSACTIONAL, MARKETING, OTP
       $components ="";
       
       $components_array = array();
       
       //BODY
       //$example = array('body_text' => array('174e6121bda70_screen.jpg'));
       if($request->templateBody=='true'){
         $exampleBody= $request->templateExampleBody;
         $bodyText= $request->templateBodyText;
         if($request->templateBodyVariable=='true'){
            $exampleBodyArray = array('body_text' => array(array($exampleBody)));
            $components_array = isset($request->templateBody) ? array_merge($components_array,array(array('type'=> 'BODY','text'=> $bodyText , 'example'=> $exampleBodyArray )))  : $components_array ;
         }else{
            $components_array = isset($request->templateBody) ? array_merge($components_array,array(array('type'=> 'BODY','text'=> $bodyText )))  : $components_array ;
         }
       }
       
       
       //HEADER
       $exampleHeader= $request->templateExampleHeader; //cibe array de textos
       if($request->templateHeader=='true'){
         if($request->templateHeaderType=='TEXT'){
           $headerText = $request->templateHeaderText ;
           if($request->templateHeaderVariable=='true'){
              $exampleHeaderArray = array('header_text' => array($exampleHeader));
              $components_array = isset($request->templateHeader) ? array_merge($components_array,array(array('type'=> 'HEADER','format'=> $request->templateHeaderType,'text'=> $headerText , 'example'=> $exampleHeaderArray )))  : $components_array ;
           }else{
              $components_array = isset($request->templateHeader) ? array_merge($components_array,array(array('type'=> 'HEADER','format'=> $request->templateHeaderType,'text'=> $headerText )))  : $components_array ;  
           }
         }elseif($request->templateHeaderType=='IMAGE' || $request->templateHeaderType=='DOCUMENT'  || $request->templateHeaderType=='VIDEO' ){ //$request->templateHeaderType=='LOCATION'
           if(isset($request->templateHeaderTypeHandle)){
             $exampleHeaderArray = array('header_handle' => array($exampleHeader));
           }
           if(isset($request->templateHeaderTypeUrl)){
             $exampleHeaderArray = array('header_url' => array($exampleHeader));
           }
           $components_array = isset($request->templateHeader) ? array_merge($components_array,array(array('type'=> 'HEADER','format'=> $request->templateHeaderType, 'example'=> $exampleHeaderArray )))  : $components_array ;
         };
         
       };
       
       //FOOTTER
       if($request->templateFooter=='true'){
         $footerText= $request->templateFooterText;
         $components_array = isset($request->templateFooter) ? array_merge($components_array,array(array('type'=> 'FOOTER','text'=> $footerText )))  : $components_array ;
       }
       
       //$components_array = isset($request->templateButtons) ? array_merge($components_array,array(array('type'=> 'BUTTONS','text'=> 'Well done is better than well said' )))  : $components_array ;
       //QUICK_REPLY, URL, PHONE_NUMBER}
       //TEXT, IMAGE, DOCUMENT, VIDEO, LOCATION
       //https://developers.facebook.com/docs/graph-api/reference/whats-app-business-account/message_templates/#Creating
       //https://developers.facebook.com/docs/whatsapp/business-management-api/message-templates?locale=es_ES
       
       $components = json_encode($components_array);
       //return $components_array;
       
       $apiURL = env('GRAPH_FACEBOOK_v14').$whatsappBusinessAccountID.'/message_templates?name='.$templateName.'&language='.$language.'&category='.$category.'&components='.$components.'&access_token='.$userAccessToken;
       
       //return $apiURL;
       //return $apiURL;
       $response = Http::post($apiURL);
      
       
       $statusCode = $response->status();
       $responseBody = json_decode($response->getBody(), true);
       
       return json_encode($responseBody);
       
    }
    
    public function listarMessagesTemplate(Request $request)
    {
       
       $whatsappBusinessAccountID = $request->whatsappBusinessAccountID;//101573755994797
       $userAccessToken = $request->userAccessToken; //EAAPmKaDlIbEBAPFLZC4tyq6e2hb3p0yjEyzZChcZAeZBHHfjlvwtGpt2pMZC3YUumI1sGFeoAvgZA8JfZBMMgpqcZAnKpF7sRQwSMF9FeqYUjUmnsHfyhcob5hne9HbZBgNN9XYo8VZAvrwmEvJ7tALisZCB6wZB3Q20ZBzZBis3ilhEjjquvHmxR4XHkCYj4zuUGSF5lwA3zxHUcxWZBdEjuDlZBS9R
       $limit = $request->limit;
       
       $apiURL = env('GRAPH_FACEBOOK_v14').$whatsappBusinessAccountID.'/message_templates?limit='.$limit.'&access_token='.$userAccessToken;
       $response = Http::get($apiURL);
      
       $statusCode = $response->status();
       $responseBody = json_decode($response->getBody(), true);
       
       return json_encode($responseBody);
       
    }
    
    
    //https://developers.facebook.com/docs/whatsapp/business-management-api/message-templates?locale=es_ES
    public function obtenerEspacioTemplate (Request $request) // espacio de nombres
    {
       
       $whatsappBusinessAccountID = $request->whatsappBusinessAccountID;//101573755994797
       $userAccessToken = $request->userAccessToken; //EAAPmKaDlIbEBAPFLZC4tyq6e2hb3p0yjEyzZChcZAeZBHHfjlvwtGpt2pMZC3YUumI1sGFeoAvgZA8JfZBMMgpqcZAnKpF7sRQwSMF9FeqYUjUmnsHfyhcob5hne9HbZBgNN9XYo8VZAvrwmEvJ7tALisZCB6wZB3Q20ZBzZBis3ilhEjjquvHmxR4XHkCYj4zuUGSF5lwA3zxHUcxWZBdEjuDlZBS9R
  
       $apiURL = env('GRAPH_FACEBOOK_v14').$whatsappBusinessAccountID.'?fields=name,message_template_namespace&access_token='.$userAccessToken;
       $response = Http::get($apiURL);
      
       $statusCode = $response->status();
       $responseBody = json_decode($response->getBody(), true);
       
       return json_encode($responseBody);
       
    }
    
    
    public function eliminarTemplate (Request $request) // espacio de nombres
    {
       
       $whatsappBusinessAccountID = $request->whatsappBusinessAccountID;//101573755994797
       $userAccessToken = $request->userAccessToken; //EAAPmKaDlIbEBAPFLZC4tyq6e2hb3p0yjEyzZChcZAeZBHHfjlvwtGpt2pMZC3YUumI1sGFeoAvgZA8JfZBMMgpqcZAnKpF7sRQwSMF9FeqYUjUmnsHfyhcob5hne9HbZBgNN9XYo8VZAvrwmEvJ7tALisZCB6wZB3Q20ZBzZBis3ilhEjjquvHmxR4XHkCYj4zuUGSF5lwA3zxHUcxWZBdEjuDlZBS9R
       $templateName = $request->templateName; //hello_world_template
       
       $apiURL = env('GRAPH_FACEBOOK_v14').$whatsappBusinessAccountID.'/message_templates?name='.$templateName.'&access_token='.$userAccessToken;
       $response = Http::delete($apiURL);
      
       $statusCode = $response->status();
       $responseBody = json_decode($response->getBody(), true);
       
       return json_encode($responseBody);
       
    }
  
 


/*curl -X  POST \
 'https://graph.facebook.com/v13.0/FROM_PHONE_NUMBER_ID/messages' \
 -H 'Authorization: Bearer ACCESS_TOKEN' \
 -d '{
  "messaging_product": "whatsapp",
  "recipient_type": "individual",
  "to": "PHONE_NUMBER",
  "type": "template",
  "template": {
    "name": "TEMPLATE_NAME",
    "language": {
      "code": "LANGUAGE_AND_LOCALE_CODE"
    },
    "components": [
      {
        "type": "body",
        "parameters": [
          {
            "type": "text",
            "text": "text-string"
          },
          {
            "type": "currency",
            "currency": {
              "fallback_value": "",
              "": "",
              "": 
            }
          },
          {
            "type": "date_time",
            "date_time": {
              "fallback_value": "DATE"
            }
          }
        ]
      }
    ]
  }
}'*/

    
   
    
    
    public function editar(Request $request)
    {
        $x = Empresa::find($request->get("empresa_id")); 
        $x->empresa_nombre = $request->get("empresa_nombre");
        $x->empresa_ruc = $request->get("empresa_ruc");
        $x->empresa_pagina_oficial = $request->get("empresa_pagina_oficial");
        $x->empresa_url_logo = $request->get("empresa_url_logo");
        $x->empresa_correo = $request->get("empresa_correo");
        $x->empresa_telefono = $request->get("empresa_telefono");
        $x->empresa_descripcion = $request->get("empresa_descripcion");
        $x->empresa_direccion = $request->get("empresa_direccion");
        $x->empresa_gps_latitud = $request->get("empresa_gps_latitud");
        $x->empresa_gps_longitud = $request->get("empresa_gps_longitud");
        $x->estado = $request->get("estado");
        
        if($x->save()){ return json_encode(["data"=>$x->toArray(),'resultado'=>"true" ]); }
        else{ return json_encode(['resultado'=>"error",'mensaje'=>"Ocurrio un error, vuelva a cargar la página"]); }
    }
    
    public function obtener(Request $request)
    {
       $x = Empresa::where('empresa_id',$request->get("empresa_id"))->get();
       if($x){ return json_encode(["data"=>$x->toArray(),'resultado'=>"true" ]); }
       else{ return json_encode(['resultado'=>"error",'mensaje'=>"no se encontraron registros"]); }
    }
    
    public function listar(Request $request)
    {
       $x = Empresa::get();
       if($x){ return json_encode(["data"=>$x->toArray(),'resultado'=>"true" ]); }
       else{ return json_encode(['resultado'=>"error",'mensaje'=>"no se encontraron registros"]); }
    }
    
    public function eliminar(Request $request)
    {
       $x = Empresa::where('empresa_id',$request->get("empresa_id"))->delete();
       if($x){ return json_encode(["data"=>"se elimino con exito",'resultado'=>"true" ]); }
       else{ return json_encode(['resultado'=>"error",'mensaje'=>"no se encontraron registros"]); }
    }
    
}
