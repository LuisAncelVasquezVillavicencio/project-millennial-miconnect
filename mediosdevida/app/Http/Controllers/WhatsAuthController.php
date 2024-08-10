<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Config_wassap;
use Auth;


class WhatsAuthController extends Controller
{
   
   public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    //
    public function config(Request $request){
       
       $instancias = Config_wassap::get();
       
       if($request->ajax()){
         $instancias = Config_wassap::get();
         return view("Config.config_whats_lista",["instancias"=>$instancias])->render(); 
       }
       
       return view("Config.config_whats",["instancias"=>$instancias]);
       
    }
    
    public function status(Request $request){
      
      $instancias = Config_wassap::where("ID_WASSAP","=",$request->get("id"))->first();
      $APIurl =  $instancias->URL;
      $token  =  $instancias->API_KEY;
      
      $url = $APIurl.'status?token='.$token;
      // Make a POST request
      $options = stream_context_create(['http' => [
                        'method'  => 'GET',
                        'header'  => 'Content-type: application/json'
                    ]
       ]);
        // Send a request
      $result = json_decode(file_get_contents($url, false, $options));
      
      if($result->accountStatus == "authenticated"){
         $data =[
            "Estado" => true,
            // "Opciones"=>
            // "<button class='btn btn-icon btn-pill' onclick=\"Salir('".$request->get("id")."')\">"."<i class='fa fa-sign-out' ></i> Salir"."</button>"
            ];
         return json_encode($data);
      }
      else{
         if($request->get("tipo") == "List"){
         $data =[
            "Estado" => false,
            // "Opciones"=>
            // "<button class='btn btn-icon btn-pill' onclick=\"Modal('".$request->get("id")."')\">"."<i class='fa fa-sign-in' ></i> Abrir"."</button>"
            ];
         }
         else{
            $data = [
           "Estado" => false ];
         }
         return json_encode($data);
      }
   
    }
    
    public function logout(Request $request){
       
         $id_instancia = $request->get("id");
         $instancias = Config_wassap::where("ID_WASSAP","=",$request->get("id"))->first();
         $APIurl =  $instancias->URL;
         $token  =  $instancias->API_KEY;
         
         $url = $APIurl.'logout?token='.$token;
         // Make a POST request
         $options = stream_context_create(['http' => [
                           'method'  => 'GET',
                           'header'  => 'Content-type: application/json'
                       ]
          ]);
           // Send a request
         $result = json_decode(file_get_contents($url, false, $options));
         
         if($result->result == "Logout request sent to WhatsApp"){
            $data = [
                 "Estado" => true];
            
            $instancias->ESTADO = "got qr code";
            $instancias->save();
            return json_encode($data);   
         }
         else{
            $data = [
                 "Estado" => false];
              
            return json_encode($data); 
         }

    }
    public function status_un(Request $request){
       
      if($request->ajax()){
         
         $id_instancia = $request->get("id");
         $instancias = Config_wassap::where("ID_WASSAP","=",$request->get("id"))->first();
         $APIurl =  $instancias->URL;
         $token  =  $instancias->API_KEY;
         
         $url = $APIurl.'status?token='.$token;
         // Make a POST request
         $options = stream_context_create(['http' => [
                           'method'  => 'GET',
                           'header'  => 'Content-type: application/json'
                       ]
          ]);
           // Send a request
         $result = json_decode(file_get_contents($url, false, $options));
         
         if($result->accountStatus != "authenticated"){
            if(isset($result->qrCode)){
            //  dd(base64_decode( $result->qrCode, $strict = true ));
              $data = [
                 "Estado" => false,
                 "qr" =>  $result->qrCode];
              
              return json_encode($data);
            }
            else{
              $data = [
                 "Estado" => false,
                 "Mensaje" => "Hubo un problema, cierre este cuadro y vuelva a intentarlo"];
              return json_encode($data);
            }
         }
         else{
            $data = [
                 "Estado" => true,
                 "Mensaje" => "Ya se encuentra conectado"];
              return json_encode($data);
         }
       }
    }
    
    public function config_v2(Request $request){
       
       $instancias = Config_wassap::where("MOSTRAR","SI")->get();
       
    //   if($request->ajax()){
    //      $instancias = Config_wassap::get();
    //      return view("Config.config_whats_lista",["instancias"=>$instancias])->render(); 
    //   }
       
    //   return view("Config.Config_v2.config_whats_v2",["instancias"=>$instancias]);
       return view("Config.Config_v2.config_whats_v2_solo",["instancias"=>$instancias]);
       
    }
    
    public function status_full(){
        
        $instancias = Config_wassap::select("ID_WASSAP",'ESTADO','PROPIETARIO')->where("MOSTRAR","SI")->get();
        
        $data = [
            "instancias" => $instancias
            ];
        
        return $data ;
        
    }
    public function modal_instancia(Request $request){
        
        $instancia = Config_wassap::find($request->get("b"));
        
        return view("Config.Config_v2.config_whats_v2_modal",compact("instancia"))->render();
    }
    public function guardar_form(Request $request){
        
        
        $instancia = Config_wassap::updateOrCreate(["ID_WASSAP" => $request->get("ID_WHATS")],[
            "PROPIETARIO" => $request->get("PROPIETARIO"),"NUMERO" => $request->get("NUMERO")
            ,"API_KEY" =>$request->get("API_KEY"),"URL" => $request->get("URL"),"INSTANCIA"=>$request->get("INSTANCIA")
            ,"MOSTRAR" => "SI"
            ]);
        
        
        return "Guardado con exito";
    }
    public function quitar_instancia(Request $request){
       $instancia = Config_wassap::find($request->get("b"));
       $instancia->MOSTRAR = "NO";
       
       $res = $instancia->save();
       
       return $res;
    }
    
    public function status_conn(){
        
        $instancias = Config_wassap::select("ID_WASSAP",'ESTADO','PROPIETARIO')->where("MOSTRAR","SI")->first();
        
        $data = [
            "instancias" => $instancias
            ];
        
        return $data ;
        
    }
}
