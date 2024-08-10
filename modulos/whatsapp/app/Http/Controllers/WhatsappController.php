<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use App\Empresa;
use Illuminate\Support\Facades\Http;
use OpenApi\Annotations as OA;
use App\WhatsappConfig;
use App\WhatsappSend;
use App\WhatsappTemplate;

use Log;
use DB;
use App\WhatsappStatus;
use App\WhatsappRecive;
/**
* @OA\SecurityScheme(
*      securityScheme="bearerAuth",
*      in="header",
*      name="bearerAuth",
*      type="http",
*      scheme="bearer",
*      bearerFormat="JWT",
* ),
* */

class WhatsappController extends Controller
{
    
    
     //https://github.com/DarkaOnLine/L5-Swagger
 
    //composer require "darkaonline/l5-swagger"
    //php artisan l5-swagger:generate
    //https://developers.facebook.com/docs/whatsapp/cloud-api/guides/send-messages
    
    
   
    
   
    /**
    * @OA\Post(
     *     path="/whatsapp/sendTextMessages",
     *     tags={"sendTextMessages"},
     *     summary="Envio de mensaje de texto",
     *     description="Permite el envio de mensajes de texto por whatsapp",
     *     operationId="sendTextMessages",
     *     deprecated=false,
     * 
     * 
     *     @OA\Parameter(
     *         name="to",
     *         in="query",
     *         description="Numero de telefono al cual se enviara el mensaje debe contener el codigo del pais",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *             example="51993370198"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="idNumTel",
     *         in="query",
     *         description="Identificador de número de teléfono brindado por facebook",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *             example="109949925143071"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="recipient_type",
     *         in="query",
     *         description="actualmante solo individual",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *             example="individual"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="preview_url",
     *         in="query",
     *         description="se coloca true si el texto contiene https y false si no tiene",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *             example="false"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="body",
     *         in="query",
     *         description="Texto o contenido del mensaje",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *             example="hola"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="token",
     *         in="query",
     *         description="Token de Facebook Api Whatsapp",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *             example="Bearer EAAPmKaDlIbEBAGuIu2KtIeX2MoWsS2P6THLmjixBZA8OmvdQqF989hKdRO9ZCTMVMk0acZAJT8nIUZC769T4uGyBO1ORR0Hj6Y6JLoZAC"
     *         )
     *     ),
     * 
     * 
     * 
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *              @OA\Items(
     *                      @OA\Property(
     *                         property="messaging_product",
     *                         type="string",
     *                         example="whatsapp"
     *                      ),
     *                      @OA\Property(
     *                         property="contacts",
     *                         type="string",
     *                         items="[{ input: PHONE_NUMBER , wa_id: WHATSAPP_ID }]"
     *                      ),
     *                      @OA\Property(
     *                         property="messages",
     *                         type="string",
     *                         items="[{ id: wamid.ID }]"
     *                      ),
     *              ),
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
    */
    // llama al la funcion sin necesidad de la bd
    function sendTextMessages(Request $request){
        $idNumTel = $request->idNumTel;//109949925143071 //Identificador de número de teléfono
        $to = $request->to;//51941695131
        $recipient_type = $request->recipient_type;//individual
        $preview_url = $request->preview_url;// "false"; //si hay https
        $body = $request->body;// texto
        $token = $request->token; // Bearer EAAPmKaDlIbEBAGuIu2KtIeX2MoWsS2P6THLmjixBZA8OmvdQqF989hKdRO9ZCTMVMk0acZAJT8nIUZC769T4uGyBO1ORR0Hj6Y6JLoZACVGIvM8PAehPwnycdY4m1yOSiq7MpsKhgpjpFyHEIOgHEYZAOZBjuSReDaJe5TDmyeAVvJT6nwupyH2ti8fmTSc7vvXmBSZCksMvGL1tIzTAg8KW
        $response =  $this->whatsappSendTextMessages($idNumTel,$to,$recipient_type,$preview_url,$body,$token);
    }
    // llama al la funcion desde la configuracion de la bd
    function sendTextMessagesConfigId(Request $request ){
        $whatsappConfig = WhatsappConfig::where('id',$request->configid)->first();
        $idNumTel = $whatsappConfig->idNumTel;
        $token = $whatsappConfig->idNumTelToken; 
        $to = $request->to;
        $recipient_type = $request->recipient_type;
        $preview_url = $request->preview_url;
        $body = $request->body;
        $response =  $this->whatsappSendTextMessages($idNumTel,$to,$recipient_type,$preview_url,$body,$token);
        //almacenar envio
        $messages_id=$response['messages'][0]['id'];
        $contacts_input=$response['contacts'][0]['input'];
        $contacts_wa_id=$response['contacts'][0]['wa_id'];
        $this->guardarWhatsappSendTextMessages('1',$idNumTel,$to,$recipient_type,$preview_url,$body,$request->configid ,$messages_id, $contacts_input, $contacts_wa_id);
        //falta error
        return $response;
    }
    function whatsappSendTextMessages($idNumTel,$to,$recipient_type,$preview_url,$body,$token){
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
        return $responseBody;
    }
    function guardarWhatsappSendTextMessages($id_user,$idNumTel,$to,$recipient_type,$preview_url,$body,$idWhatsappConfig, $messages_id, $contacts_input, $contacts_wa_id){
        $x = new WhatsappSend();
        $x->metodo = "whatsappSendTextMessages";
        $x->idNumTel = $idNumTel;
        $x->to = $to;
        $x->recipient_type = $recipient_type;
        $x->preview_url = $preview_url;
        $x->body = $body;
        $x->type = "text";
        $x->idWhatsappConfig = $idWhatsappConfig;
        $x->contacts_input = $contacts_input ;
        $x->contacts_wa_id = $contacts_wa_id;
        $x->messages_id = $messages_id;
        $x->id_user = $id_user;
        $x->messages_timestamp = Carbon::now()->timestamp;
        $x->save();
    }
    
    
    /*Envio de archivos multimedia*/
    function sendMediaMessages(Request $request){
        //Identificador de número de teléfono
        $idNumTel = $request->idNumTel;//109949925143071
        $to = $request->to;//51941695131
        $recipient_type = $request->recipient_type;//individual
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
        
        $body = $request->body;// "false"; //si hay https
        $token = $request->token; // Bearer EAAPmKaDlIbEBAGuIu2KtIeX2MoWsS2P6THLmjixBZA8OmvdQqF989hKdRO9ZCTMVMk0acZAJT8nIUZC769T4uGyBO1ORR0Hj6Y6JLoZACVGIvM8PAehPwnycdY4m1yOSiq7MpsKhgpjpFyHEIOgHEYZAOZBjuSReDaJe5TDmyeAVvJT6nwupyH2ti8fmTSc7vvXmBSZCksMvGL1tIzTAg8KW
        
        
        $messaging_product = "whatsapp";//whatsapp
       
        
        $apiURL = env('GRAPH_FACEBOOK').$idNumTel.'/messages';
        
        $postInput = [
                'messaging_product' => "whatsapp", 
                "recipient_type"  => $recipient_type,
                'to' => $to,
                'type' => 'template',
                'template' => [ 'name' => 'hello_world',
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
    function sendTextMessagesTemplateConfigId(Request $request){
        
            $whatsappConfig = WhatsappConfig::where('id',$request->configid)->first();
            //Identificador de número de teléfono
            $idNumTel = $whatsappConfig->idNumTel;//109949925143071
            $token = $whatsappConfig->idNumTelToken; // Bearer EAAPmKaDlIbEBAGuIu2KtIeX2MoWsS2P6THLmjixBZA8OmvdQqF989hKdRO9ZCTMVMk0acZAJT8nIUZC769T4uGyBO1ORR0Hj6Y6JLoZACVGIvM8PAehPwnycdY4m1yOSiq7MpsKhgpjpFyHEIOgHEYZAOZBjuSReDaJe5TDmyeAVvJT6nwupyH2ti8fmTSc7vvXmBSZCksMvGL1tIzTAg8KW
            $to = $request->to;//51941695131
            $recipient_type = $request->recipient_type;//individual
            $apiURL = env('GRAPH_FACEBOOK').$idNumTel.'/messages';

            $whatsappTemplate = WhatsappTemplate::where('id',$request->whatsappTemplateid)->first();  
            
            
            //return $whatsappTemplate;
            
            if($whatsappTemplate->templateBodyVariable=='true' and  $whatsappTemplate->templateHeaderVariable=='true'){
                
                $components_array = array();
               /* if($whatsappTemplate->templateBodyVariable=='true'){
                   $components_array = isset($request->templateBody) ? array_merge($components_array,array(array('type'=> 'body','parameters'=> array(array('type'=> 'text', 'text' => 'text-string'))  )))  : $components_array ;
                }
               
                if($request->templateBodyVariable=='true'){
                    $exampleBodyArray = array('body_text' => array(array($exampleBody)));
                   
                }else{
                    $components_array = isset($request->templateBody) ? array_merge($components_array,array(array('type'=> 'BODY','text'=> $bodyText )))  : $components_array ;
                }
                  arrayTextBodyVariables
            countTextBodyVariables
            textHeaderVariable*/
                
                $postInput = [
                    'messaging_product' => "whatsapp", 
                    "recipient_type"  => $recipient_type,
                    'to' => $to,
                    'type' => 'template',
                    'template' => [ 'name' => $whatsappTemplate->templateName,
                                    'language' => [ 'code' => $whatsappTemplate->language ] ,
                                    'components' => $components_array
                    ]
                ];
            }else{
                $postInput = [
                    'messaging_product' => "whatsapp", 
                    "recipient_type"  => $recipient_type,
                    'to' => $to,
                    'type' => 'template',
                    'template' => [ 'name' => $whatsappTemplate->templateName,
                                    'language' => [ 'code' => $whatsappTemplate->language ] 
                    ]
                ];
            }
          
            //return $postInput;
            /*'components' => [[
                                      'type' => 'body' ,
                                      'parameters' => [
                                        [ 'type' => 'text' , 'text' => 'text-string' ]
                                        //[ 'type' => 'currency' , 'currency' => [ 'fallback_value' => 'VALUE' ,'code' => 'USD' ,'amount_1000' => 'NUMBER'  ] ],
                                        //[ 'type' => 'date_time' , 'date_time' => [ 'fallback_value' => 'DATE' ] ]
                                      ]
                                    ]] */
                                    
            
            
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
  
   
    
    public function listarTemplateDBConfigId(Request $request)
    {
       $whatsappConfig = WhatsappTemplate::where('id_config',$request->configid)->get();
       return json_encode($whatsappConfig);
    }
    public function listarTemplateDBId(Request $request)
    {
       $whatsappConfig = WhatsappTemplate::where('id',$request->templateid)->first();
       return json_encode($whatsappConfig);
    }
  
    //https://developers.facebook.com/docs/whatsapp/business-management-api/message-templates/
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
    
    public function listarMessagesTemplateConfigId(Request $request)
    {
       $whatsappConfig = WhatsappConfig::where('id',$request->configid)->first();
       $whatsappBusinessAccountID = $whatsappConfig->whatsappBusinessAccountID;//101573755994797
       $userAccessToken = $whatsappConfig->userAccessToken; //EAAPmKaDlIbEBAPFLZC4tyq6e2hb3p0yjEyzZChcZAeZBHHfjlvwtGpt2pMZC3YUumI1sGFeoAvgZA8JfZBMMgpqcZAnKpF7sRQwSMF9FeqYUjUmnsHfyhcob5hne9HbZBgNN9XYo8VZAvrwmEvJ7tALisZCB6wZB3Q20ZBzZBis3ilhEjjquvHmxR4XHkCYj4zuUGSF5lwA3zxHUcxWZBdEjuDlZBS9R
       $limit = $request->limit;
       $apiURL = "";
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
  
  
    public function sincronizarTemplateDB(Request $request) // espacio de nombres
    {
       $id_user="1";
       $whatsappConfig = WhatsappConfig::where('id',$request->configid)->first();
       $whatsappBusinessAccountID = $whatsappConfig->whatsappBusinessAccountID;//101573755994797
       $userAccessToken = $whatsappConfig->userAccessToken; //EAAPmKaDlIbEBAPFLZC4tyq6e2hb3p0yjEyzZChcZAeZBHHfjlvwtGpt2pMZC3YUumI1sGFeoAvgZA8JfZBMMgpqcZAnKpF7sRQwSMF9FeqYUjUmnsHfyhcob5hne9HbZBgNN9XYo8VZAvrwmEvJ7tALisZCB6wZB3Q20ZBzZBis3ilhEjjquvHmxR4XHkCYj4zuUGSF5lwA3zxHUcxWZBdEjuDlZBS9R
       $idTemplate = $request->idTemplate;
       $limit = 1000;
       $apiURL = "";
       $apiURL = env('GRAPH_FACEBOOK_v14').$whatsappBusinessAccountID.'/message_templates?limit='.$limit.'&access_token='.$userAccessToken;
       $response = Http::get($apiURL);
       $statusCode = $response->status();
       $responseBody = json_decode($response->getBody(), true);
       
       foreach ($responseBody['data'] as $item) {
            if ($item['id'] == $idTemplate){
                
                
                $x = WhatsappTemplate::where('id_template',$idTemplate)->where('id_config',$request->configid)->first();
                if($x){
                    $x->templateName = $item['name'] ;
                    $x->language = $item['language'] ;
                    $x->category = $item['category'] ; 
                    
                    //$x->templateExampleBody = '' ; //exemplo body
                    
                    foreach ($item['components'] as $c) {
                        if ($c['type'] == 'BODY'){
                            $x->templateBody = "true"; //true o false
                            $x->templateBodyText = $c['text'] ;
                        }
                        if ($c['type'] == 'HEADER'){
                            $x->templateHeader = "true"; //true o false
                            $x->templateHeaderType = $c['format'] ;
                            if($c['format']=='TEXT'){
                                $x->templateHeaderText = $c['text'];    
                            }
                        }
                        if ($c['type'] == 'FOOTER'){
                            $x->templateFooter = "true"; //true o false
                            $x->templateFooterText = $c['text'];
                        }
                    }
                    //$x->templateBodyVariable = $templateBodyVariable;//TRUE O FALSE SI CONTIENE VARIABLES
                    //$x->templateExampleHeader = $templateExampleHeader;
                    //$x->templateHeaderVariable = $templateHeaderVariable;
                    //$x->templateHeaderTypeHandle = $templateHeaderTypeHandle;
                    //$x->templateHeaderTypeUrl = $templateHeaderTypeUrl;
                    $x->id_user = $id_user;
                    $x->save();
                }else{
                    $x = new WhatsappTemplate();
                    $x->id_template = $idTemplate;
                    $x->id_config = $request->configid;
                    $x->templateName = $item['name'] ;
                    $x->language = $item['language'] ;
                    $x->category = $item['category'] ; 
                    
                    //$x->templateExampleBody = '' ; //exemplo body
                    
                    foreach ($item['components'] as $c) {
                        if ($c['type'] == 'BODY'){
                            $x->templateBody = "true"; //true o false
                            $x->templateBodyText = $c['text'] ;
                        }
                        if ($c['type'] == 'HEADER'){
                            $x->templateHeader = "true"; //true o false
                            $x->templateHeaderType = $c['format'] ;
                            if($c['format']=='TEXT'){
                                $x->templateHeaderText = $c['text'];    
                            }
                        }
                        if ($c['type'] == 'FOOTER'){
                            $x->templateFooter = "true"; //true o false
                            $x->templateFooterText = $c['text'];
                        }
                    }
                    //$x->templateBodyVariable = $templateBodyVariable;//TRUE O FALSE SI CONTIENE VARIABLES
                    //$x->templateExampleHeader = $templateExampleHeader;
                    //$x->templateHeaderVariable = $templateHeaderVariable;
                    //$x->templateHeaderTypeHandle = $templateHeaderTypeHandle;
                    //$x->templateHeaderTypeUrl = $templateHeaderTypeUrl;
                    $x->id_user = $id_user;
                    $x->save();
                }
                
                
                
                
            }
       }
       
       
        


        return json_encode($x);
       
    }
  
    public function ObtenerTemplatexId(Request $request) // espacio de nombres
    {
       $whatsappConfig = WhatsappConfig::where('id',$request->configid)->first();
       $whatsappBusinessAccountID = $whatsappConfig->whatsappBusinessAccountID;//101573755994797
       $userAccessToken = $whatsappConfig->userAccessToken; //EAAPmKaDlIbEBAPFLZC4tyq6e2hb3p0yjEyzZChcZAeZBHHfjlvwtGpt2pMZC3YUumI1sGFeoAvgZA8JfZBMMgpqcZAnKpF7sRQwSMF9FeqYUjUmnsHfyhcob5hne9HbZBgNN9XYo8VZAvrwmEvJ7tALisZCB6wZB3Q20ZBzZBis3ilhEjjquvHmxR4XHkCYj4zuUGSF5lwA3zxHUcxWZBdEjuDlZBS9R
       $idTemplate = $request->idTemplate;
       $limit = 1000;
       $apiURL = "";
       $apiURL = env('GRAPH_FACEBOOK_v14').$whatsappBusinessAccountID.'/message_templates?limit='.$limit.'&access_token='.$userAccessToken;
       $response = Http::get($apiURL);
       $statusCode = $response->status();
       $responseBody = json_decode($response->getBody(), true);
       
       foreach ($responseBody['data'] as $item) {
            if ($item['id'] == $idTemplate){
                return json_encode($item);
            }
       }
    }
    
    
    public function listarMessagesTemplateConfigIdBD(Request $request) // espacio de nombres
    {
       $whatsappTemplate = WhatsappTemplate::where('id_template',$request->idTemplate)->where('id_config',$request->configid)->first();
       if($whatsappTemplate){
            return $whatsappTemplate->toJson();
       }else{
            return "No existe";
       }
    }
       
       
    //caragra rchobos a afcebook https://developers.facebook.com/docs/graph-api/guides/upload
    // lenguajes https://developers.facebook.com/docs/whatsapp/api/messages/message-templates#language
    
    /*public function editar(Request $request)
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
    }*/
    
    
    //https://developers.facebook.com/docs/whatsapp/business-management-api/message-templates?locale=es_ES
    
    public function crearMessagesTemplatea(Request $request)
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
    
    // llama al la funcion desde la configuracion de la bd
    function crearMessagesTemplateConfigId(Request $request ){
        $whatsappConfig = WhatsappConfig::where('id',$request->configid)->first();
        $whatsappBusinessAccountID = $whatsappConfig->whatsappBusinessAccountID; 
        $userAccessToken = $whatsappConfig->userAccessToken; 
        //$whatsappBusinessAccountID = $request->whatsappBusinessAccountID;//101573755994797
        //$userAccessToken = $request->userAccessToken; 
        $templateName=$request->templateName;
        $language= $request->language; //https://developers.facebook.com/docs/whatsapp/api/messages/message-templates#language
        $category= $request->category;//TRANSACTIONAL, MARKETING, OTP
        $templateBody = $request->templateBody;
        $templateExampleBody= $request->templateExampleBody;
        $templateBodyText = $request->templateBodyText;
        $templateBodyVariable = $request->templateBodyVariable;
        $templateExampleHeader = $request->templateExampleHeader;
        $templateHeader = $request->templateHeader;
        $templateHeaderType = $request->templateHeaderType;
        $templateHeaderVariable = $request->templateHeaderVariable;
        $templateHeaderText = $request->templateHeaderText;
        $templateHeaderTypeHandle = $request->templateHeaderTypeHandle;
        $templateHeaderTypeUrl = $request->templateHeaderTypeUrl;
        $templateFooter = $request->templateFooter;
        $templateFooterText = $request->templateFooterText;
        $response =  $this->crearMessagesTemplate($whatsappBusinessAccountID,
                                          $userAccessToken,
                                          $templateName,
                                          $language,
                                          $category,
                                          $templateBody,
                                          $templateExampleBody,
                                          $templateBodyText,
                                          $templateBodyVariable,
                                          $templateExampleHeader,
                                          $templateHeader,
                                          $templateHeaderType,
                                          $templateHeaderVariable,
                                          $templateHeaderText,
                                          $templateHeaderTypeHandle,
                                          $templateHeaderTypeUrl,
                                          $templateFooter,
                                          $templateFooterText);
        //almacenar envio
        $id_user="1";
        
        try {
        $id_template = array_values(json_decode($response,true));//devielto por facebook al crear
        $this->guardarMessagesTemplate($id_user,$id_template[0],$request->configid,
                                          $templateName,
                                          $language,
                                          $category,
                                          $templateBody,
                                          $templateExampleBody,
                                          $templateBodyText,
                                          $templateBodyVariable,
                                          $templateExampleHeader,
                                          $templateHeader,
                                          $templateHeaderType,
                                          $templateHeaderVariable,
                                          $templateHeaderText,
                                          $templateHeaderTypeHandle,
                                          $templateHeaderTypeUrl,
                                          $templateFooter,
                                          $templateFooterText);
                                          
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
        return $response;
    }
    public function crearMessagesTemplate($whatsappBusinessAccountID,
                                          $userAccessToken,
                                          $templateName,
                                          $language,
                                          $category,
                                          $templateBody,
                                          $templateExampleBody,
                                          $templateBodyText,
                                          $templateBodyVariable,
                                          $templateExampleHeader,
                                          $templateHeader,
                                          $templateHeaderType,
                                          $templateHeaderVariable,
                                          $templateHeaderText,
                                          $templateHeaderTypeHandle,
                                          $templateHeaderTypeUrl,
                                          $templateFooter,
                                          $templateFooterText
                                          ){
       $components ="";
       $components_array = array();
       $templateExampleBody = explode(",", $templateExampleBody); 
       //BODY
       if($templateBody=='true'){
         if($templateBodyVariable=='true'){
            $exampleBodyArray = array('body_text' => array($templateExampleBody));
            $components_array = isset($templateBody) ? array_merge($components_array,array(array('type'=> 'BODY','text'=> $templateBodyText , 'example'=> $exampleBodyArray )))  : $components_array ;
         }else{
            $components_array = isset($templateBody) ? array_merge($components_array,array(array('type'=> 'BODY','text'=> $templateBodyText )))  : $components_array ;
         }
       }
       
       
       //HEADER
  
       if($templateHeader=='true'){
         if($templateHeaderType=='TEXT'){
           if($templateHeaderVariable=='true'){
              $exampleHeaderArray = array('header_text' => array($templateExampleHeader));
              $components_array = isset($templateHeader) ? array_merge($components_array,array(array('type'=> 'HEADER','format'=> $templateHeaderType,'text'=> $templateHeaderText , 'example'=> $exampleHeaderArray )))  : $components_array ;
           }else{
              $components_array = isset($templateHeader) ? array_merge($components_array,array(array('type'=> 'HEADER','format'=> $templateHeaderType,'text'=> $templateHeaderText )))  : $components_array ;  
           }
         }elseif($templateHeaderType=='IMAGE' || $templateHeaderType=='DOCUMENT'  || $templateHeaderType=='VIDEO' ){ //$request->templateHeaderType=='LOCATION'
           
           if(isset($templateHeaderTypeUrl)){
             $exampleHeaderArray = array('header_url' => array($templateExampleHeader));
           }else{
             if(isset($templateHeaderTypeHandle)){  $exampleHeaderArray = array('header_handle' => array($templateExampleHeader)); }
           }
           $components_array = isset($templateHeader) ? array_merge($components_array,array(array('type'=> 'HEADER','format'=> $templateHeaderType, 'example'=> $exampleHeaderArray )))  : $components_array ;
         };
       };
       //FOOTTER
       if($templateFooter=='true'){
         $components_array = isset($templateFooter) ? array_merge($components_array,array(array('type'=> 'FOOTER','text'=> $templateFooterText )))  : $components_array ;
       }
       
       
       //return dd($components_array);
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
    
    function guardarMessagesTemplate($id_user,$id_template,$configid,
                                          $templateName,
                                          $language,
                                          $category,
                                          $templateBody,
                                          $templateExampleBody,
                                          $templateBodyText,
                                          $templateBodyVariable,
                                          $templateExampleHeader,
                                          $templateHeader,
                                          $templateHeaderType,
                                          $templateHeaderVariable,
                                          $templateHeaderText,
                                          $templateHeaderTypeHandle,
                                          $templateHeaderTypeUrl,
                                          $templateFooter, $templateFooterText ){
        $x = new WhatsappTemplate();
        $x->id_template = $id_template;
        $x->id_config = $configid;
        $x->templateName = $templateName;
        $x->language = $language;
        $x->category = $category;
        $x->templateBody = $templateBody;
        $x->templateExampleBody = $templateExampleBody;
        $x->templateBodyText = $templateBodyText;
        $x->templateBodyVariable = $templateBodyVariable;
        $x->templateExampleHeader = $templateExampleHeader;
        $x->templateHeader = $templateHeader;
        $x->templateHeaderType = $templateHeaderType;
        $x->templateHeaderVariable = $templateHeaderVariable;
        $x->templateHeaderText = $templateHeaderText;
        $x->templateHeaderTypeHandle = $templateHeaderTypeHandle;
        $x->templateHeaderTypeUrl = $templateHeaderTypeUrl;
        $x->templateFooter = $templateFooter;
        $x->templateFooterText = $templateFooterText;
        $x->id_user = $id_user;
        $x->save();
    }
  
  
  
  
    // public function obtenerInfoNumeroConfigId(Request $request)
    // {
    //   $whatsappConfig = WhatsappConfig::where('id',$request->configid)->first();
    //   $whatsappBusinessAccountID = $whatsappConfig->whatsappBusinessAccountID;//101573755994797
    //   $userAccessToken = $whatsappConfig->userAccessToken; //EAAPmKaDlIbEBAPFLZC4tyq6e2hb3p0yjEyzZChcZAeZBHHfjlvwtGpt2pMZC3YUumI1sGFeoAvgZA8JfZBMMgpqcZAnKpF7sRQwSMF9FeqYUjUmnsHfyhcob5hne9HbZBgNN9XYo8VZAvrwmEvJ7tALisZCB6wZB3Q20ZBzZBis3ilhEjjquvHmxR4XHkCYj4zuUGSF5lwA3zxHUcxWZBdEjuDlZBS9R
    //   $apiURL = env('GRAPH_FACEBOOK_v14').$whatsappBusinessAccountID.'/'.$request->numero.'/?access_token='.$userAccessToken;
    //   $response = Http::get($apiURL);
    //   $statusCode = $response->status();
    //   $responseBody = json_decode($response->getBody(), true);
    //   return json_encode($responseBody);
    // }
    
    public function obtenerInfoNumeroConfigId(Request $request)
    {
       $whatsappConfig = WhatsappConfig::where('id',$request->configid)->first();
       $whatsappBusinessAccountID = $whatsappConfig->idNumTel;//101573755994797
       $userAccessToken = $whatsappConfig->idNumTelToken; //EAAPmKaDlIbEBAPFLZC4tyq6e2hb3p0yjEyzZChcZAeZBHHfjlvwtGpt2pMZC3YUumI1sGFeoAvgZA8JfZBMMgpqcZAnKpF7sRQwSMF9FeqYUjUmnsHfyhcob5hne9HbZBgNN9XYo8VZAvrwmEvJ7tALisZCB6wZB3Q20ZBzZBis3ilhEjjquvHmxR4XHkCYj4zuUGSF5lwA3zxHUcxWZBdEjuDlZBS9R
       $apiURL = env('GRAPH_FACEBOOK_v14').$whatsappBusinessAccountID.'';
       
       
       $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $userAccessToken
       ];
        
       $response = Http::withHeaders($headers)->get($apiURL);
        
   
       
       $statusCode = $response->status();
       $responseBody = json_decode($response->getBody(), true);
       return json_encode($responseBody);
    }
    // public function obtenerInfoNumeroConfigId(Request $request)
    // {
    //   $whatsappConfig = WhatsappConfig::where('id',$request->configid)->first();
    //   $whatsappBusinessAccountID = $whatsappConfig->whatsappBusinessAccountID;//101573755994797
    //   $userAccessToken = $whatsappConfig->userAccessToken; //EAAPmKaDlIbEBAPFLZC4tyq6e2hb3p0yjEyzZChcZAeZBHHfjlvwtGpt2pMZC3YUumI1sGFeoAvgZA8JfZBMMgpqcZAnKpF7sRQwSMF9FeqYUjUmnsHfyhcob5hne9HbZBgNN9XYo8VZAvrwmEvJ7tALisZCB6wZB3Q20ZBzZBis3ilhEjjquvHmxR4XHkCYj4zuUGSF5lwA3zxHUcxWZBdEjuDlZBS9R
    //   $apiURL = env('GRAPH_FACEBOOK_v14').$whatsappBusinessAccountID.'/'.$request->numero.'/?access_token='.$userAccessToken;
    //   $response = Http::get($apiURL);
    //   $statusCode = $response->status();
    //   $responseBody = json_decode($response->getBody(), true);
    //   return json_encode($responseBody);
    // }
    
    
    //optiene la lista de numeros con el cuals eha comunicado el usuario
    public function obtenerNumerosChatConfig(Request $request)
    {
       $whatsappConfig = WhatsappConfig::where('id',$request->configid)->first();
    
     
                                         
       $whatsappRecive = WhatsappRecive::select('messages_from','contacts_profile_name',DB::raw('MAX(messages_timestamp) as messages_timestamp'))
                                        ->where('metadata_display_phone_number',$whatsappConfig->numero)
                                        ->groupBy('messages_from');
                                        
       $whatsappSend = WhatsappSend::select('to', DB::raw('"" as contacts_profile_name,  MAX(created_at) as messages_timestamp'))
                                        ->where('contacts_input',$whatsappConfig->numero)
                                        ->groupBy('to')
                                        ->union($whatsappRecive)
                                        ->get(); 
                                         
                                       
       return json_encode($whatsappSend);
    }
    
    public function obtenerChatNumeroConfig(Request $request)
    {
       $whatsappConfig = WhatsappConfig::where('id',$request->configid)->first();
       
       $whatsappRecive = WhatsappRecive::select(DB::raw('"recive" as chat'),'messages_from','messages_timestamp','messages_type','messages_text_body' )
                                        ->where('messages_from',$request->numero); 
                                        
       $whatsappSend = WhatsappSend::select( DB::raw('"send" as chat'), 'to', 'messages_timestamp',DB::raw('type as messages_type,  body as messages_text_body') )
                                        ->where('to',$request->numero)
                                        ->unionAll($whatsappRecive)
                                        ->orderBy('messages_timestamp', 'ASC')
                                        ->get(); 
                                         
                                       
       return json_encode($whatsappSend);
    }
    
    
}
