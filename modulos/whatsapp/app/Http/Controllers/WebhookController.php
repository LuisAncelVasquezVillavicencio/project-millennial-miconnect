<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use OpenApi\Annotations as OA;
use Log;




use App\WhatsappDeleted;
use App\WhatsappFailed;
use App\WhatsappRecive;
use App\WhatsappStatus;

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

class WebhookController extends Controller
{
    
    
    
    function logWebhook($name,$mensaje){
      /*Log::build([
        'driver' => 'single',
        'path' => storage_path('logs/'.$name.'.log'),
      ])->info('Something happened!');*/
      
      Log::channel('webhook')->info($name.':'.$mensaje);
    }
     
     
    function webhookMiconnect(Request $request){
        
       
       //Log::info("hola");
       
       $this->logWebhook('webhook_miconnect',json_encode($request->all()));
      // $this->logWebhook('webhook_miconnect',json_encode($request->all()));
        
       //Log::info($request->method());
       //Log::info(json_encode($request->all()));
       $data = $request->all();
       
       
       
       if(isset($data['entry'][0]['changes'][0]['field'])){
          
          $field = $data['entry'][0]['changes'][0]['field'];
          if($field=='messages'){
              
              
              if(array_key_exists('statuses', $data['entry'][0]['changes'][0]['value'])){
                 
                
                 $this->guardarWhatsappStatus($data);
                 
              }else{
                  
                 //$this->logWebhook('webhook_miconnect_status',print_r($data,true));
                 $this->guardarWhatsappRecive($data); 
              }
              
          }
          
          if($field=='account_review_update'){
              //$this->guardarWhatsappRecive($data); 
          }
          
          if($field=='account_update'){
              //$this->guardarWhatsappRecive($data); 
          }
          if($field=='business_capability_update'){
              //$this->guardarWhatsappRecive($data); 
          }
          if($field=='message_template_status_update'){
              //$this->guardarWhatsappRecive($data); 
          }
          if($field=='phone_number_name_update'){
              //$this->guardarWhatsappRecive($data); 
          }
          if($field=='phone_number_quality_update'){
              //$this->guardarWhatsappRecive($data); 
          }
          
       }
       
       
      // 
       
       //$data_encore = json_encode($data);
       
       //$data_item = json_decode($message_encore);
    
      /* Log::info($request->path());
       Log::info($request->fullUrl());
       Log::info($request->method());
       
       
       Log::info(json_encode($request->all()));
       
       Log::info(json_encode($request->header()));
       Log::info(json_encode($request->input()));
       Log::info(json_encode($request->query()));
       Log::info(json_encode($request->flash()));
       

       Log::info(json_decode(file_get_contents('php://input'), true));
       Log::info(json_encode($request->ajax()));
       
       
       Log::info(json_encode($request->getContent()));
       
       
       Log::info(json_encode($request->post()));

      // $r = json_encode($request);
      // Log::info(var_dump($request));
       
       // {"hub_mode":"subscribe","hub_challenge":"1915750500","hub_verify_token":"EAAPmKaDlIbEBAIN5or2SInnO5EnqFfyrB02OJ0wG9jY4IWnswnWmaCInZCKgnSYR9XqFXD7lRWRHZCpbN9wAtslyFAooXZC8x6Hfzjvmoo0dC6ZBaQVinK1gpVCtFfMN55a5cPT2uOOHOapTyyrP9ZA5LZBFT7OkQXh85gZCyCtzIZBOLl5wZBpJpFQRWPZAoXq47lX9ZAolhVBbVU0Vw3h21MM"}
      
       //$data = json_decode(file_get_contents('php://input'), true);
       //Log::info(json_encode($data)); //print inbound message     
      //https://modulos.restocombo.com/whatsapp/public/webhook
       */
       
       //siempre retornar para
       if (isset($request->hub_challenge)) {
        
           Log::info( $request->hub_challenge );
        
           return $request->hub_challenge;
       }
       return response('OK', 200);
      
    }
    
   
    function guardarWhatsappStatus($data){
        
        $id = $data['entry'][0]['id'];
        $changes = $data['entry'][0]['changes'];
        $field = $changes[0]['field'];
        $value = $changes[0]['value'];
        
        
        $messaging_product = $value['messaging_product'];
        $display_phone_number = $value['metadata']['display_phone_number'];
        $phone_number_id = $value['metadata']['phone_number_id'];
        
        
        $statuses_id = $value['statuses'][0]['id'];
        $status = $value['statuses'][0]['status'];
        $timestamp = $value['statuses'][0]['timestamp'];
        $recipient_id = $value['statuses'][0]['recipient_id'];
        $conversation_id = $value['statuses'][0]['conversation']['id'];
        
        $conversation_origin_type = $value['statuses'][0]['conversation']['origin']['type'];
        $pricing_billable = $value['statuses'][0]['pricing']['billable'];
        $pricing_pricing_model = $value['statuses'][0]['pricing']['pricing_model'];
        $pricing_category = $value['statuses'][0]['pricing']['category'];
        
        
        
        //valida si existe la key expiration_timestamp
        if(array_key_exists('expiration_timestamp', $value['statuses'][0]['conversation'] )){   
            $expiration_timestamp = $value['statuses'][0]['conversation']['expiration_timestamp'];
        }else{
            $expiration_timestamp = "";
        }
        
     
        $x = new WhatsappStatus();
        $x->id_business_account = $id;
        $x->metadata_display_phone_number = $display_phone_number;
        $x->metadata_phone_number_id = $phone_number_id;
        $x->statuses = '';
        $x->statuses_id = $statuses_id;
        $x->statuses_recipient_id = $recipient_id;
        $x->status = $status;
        $x->timestamp = $timestamp;
        $x->conversation_id = $conversation_id;
        $x->expiration_timestamp = $expiration_timestamp;
        $x->origin_type = $conversation_origin_type;
        $x->pricing_model = $pricing_pricing_model;
        $x->pricing_billable = $pricing_billable;
        $x->category = $pricing_category;
        $x->save();
        
        
    }
    
    
    
    
    function guardarWhatsappRecive($data){
        
        $id = $data['entry'][0]['id'];
        $changes = $data['entry'][0]['changes'];
        $field = $changes[0]['field'];
        $value = $changes[0]['value'];
        
        
        $messaging_product = $value['messaging_product'];
        $display_phone_number = $value['metadata']['display_phone_number'];
        $phone_number_id = $value['metadata']['phone_number_id'];
        $profileName = $value['contacts'][0]['profile']['name'];
        $contactsWa_id = $value['contacts'][0]['wa_id'];
        $messages_from = $value['messages'][0]['from'];
        $messages_id = $value['messages'][0]['id'];
        $messages_timestamp = $value['messages'][0]['timestamp'];
      
        $messages_type = $value['messages'][0]['type'];
        $messages_text = "";
        $messages_mime_type = "";
        $messages_sha256 = "";
        $messages_codecs = "";
        
        
        $contacts_name_first_name = "";
        $contacts_name_last_name = "";
        $contacts_phones = "";
        $contacts_phones_type = "";
        
        
        $latitude = ""; 
        $longitude = ""; 
        $location_address = ""; 
        $location_name = ""; 
        $location_url = "";  
        
        if($messages_type=='text'){ 
          $messages_text = $value['messages'][0]['text']['body'];  
        }elseif($messages_type=='image'){
          $messages_mime_type = $value['messages'][0]['image']['mime_type']; 
          $messages_sha256 = $value['messages'][0]['image']['sha256'];   
          $messages_codecs = $value['messages'][0]['image']['id'];   
          if( array_key_exists('caption', $value['messages'][0]['image'] )){   
            $messages_text = $value['messages'][0]['image']['caption'];  
          }
          
        }elseif($messages_type=='video'){
          $messages_mime_type = $value['messages'][0]['video']['mime_type']; 
          $messages_sha256 = $value['messages'][0]['video']['sha256'];   
          $messages_codecs = $value['messages'][0]['video']['id'];   
          if( array_key_exists('caption', $value['messages'][0]['video'] )){   
            $messages_text = $value['messages'][0]['video']['caption'];  
          }
        }elseif($messages_type=='sticker'){
          $messages_mime_type = $value['messages'][0]['sticker']['mime_type']; 
          $messages_sha256 = $value['messages'][0]['sticker']['sha256'];   
          $messages_codecs = $value['messages'][0]['sticker']['id'];   
          if( array_key_exists('caption', $value['messages'][0]['sticker'] )){   
            $messages_text = $value['messages'][0]['sticker']['caption'];  
          }
        }elseif($messages_type=='document'){
          $messages_mime_type = $value['messages'][0]['document']['mime_type']; 
          $messages_sha256 = $value['messages'][0]['document']['sha256'];   
          $messages_codecs = $value['messages'][0]['document']['id'];   
          if( array_key_exists('caption', $value['messages'][0]['document'] )){   
            $messages_text = $value['messages'][0]['document']['caption'];  
          }
          $messages_filename = $value['messages'][0]['document']['filename']; 
        }elseif($messages_type=='audio'){
          $messages_mime_type = $value['messages'][0]['audio']['mime_type']; 
          $messages_sha256 = $value['messages'][0]['audio']['sha256'];   
          $messages_codecs = $value['messages'][0]['audio']['id'];   
          if( array_key_exists('voice', $value['messages'][0]['audio'] )){   
            $messages_text = $value['messages'][0]['audio']['voice'];  
          }
          
        }elseif($messages_type=='contacts'){
            
          $contacts_name_first_name = $value['messages'][0]['contacts'][0]['name']['first_name']; 
          $contacts_name_last_name = $value['messages'][0]['contacts'][0]['name']['last_name']; 
          $contacts_phones = $value['messages'][0]['contacts'][0]['phones'][0]['phone']; 
          $contacts_phones_type = $value['messages'][0]['contacts'][0]['phones'][0]['type']; 
          
        }elseif($messages_type=='location'){
            
          $latitude = $value['messages'][0]['location']['latitude']; 
          $longitude = $value['messages'][0]['location']['longitude']; 
          
          if( array_key_exists('address', $value['messages'][0]['location'] )){   
            $location_address = $value['messages'][0]['location']['address'];   
          }
          if( array_key_exists('audio', $value['messages'][0]['location'] )){   
            $location_name = $value['messages'][0]['location']['name'];   
          }
          if( array_key_exists('url', $value['messages'][0]['location'] )){   
            $location_url = $value['messages'][0]['location']['url'];  
          }
          
          
        }
        
        
        
        //validar type
     
        $x = new WhatsappRecive();
        $x->messaging_product = $messaging_product;
        $x->metadata_display_phone_number = $display_phone_number;
        $x->metadata_phone_number_id = $phone_number_id;
        $x->contacts_profile_name = $profileName;
        $x->contacts_wa_id = $contactsWa_id;
        $x->messages_from = $messages_from;
        $x->messages_id = $messages_id;
        $x->messages_timestamp = $messages_timestamp;
        $x->messages_type = $messages_type;
        $x->messages_text_body = $messages_text;
        $x->messages_mime_type = $messages_mime_type;
        $x->messages_sha256 = $messages_sha256 ;
        $x->messages_codecs = $messages_codecs ;
        
        
        $x->contacts_first_name = $contacts_name_first_name;
        $x->contacts_last_name = $contacts_name_last_name;
        $x->contacts_phones = $contacts_phones ;
        $x->contacts_phones_type = $contacts_phones_type ;
        
        $x->latitude = $latitude ;
        $x->longitude = $longitude ;
        
        $x->location_address = $location_address ;
        $x->location_name = $location_name ;
        $x->location_url = $location_url ;
        
        
        $x->save();
    }
    
    
}
