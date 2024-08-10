<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plantillas_grupos;

class GPlantillaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
       
       $plantillas = Plantillas_grupos::first();
       return view("Config.plantillas",compact('plantillas'));
    }
    
    public function store(Request $request){
      
      $campos=[
            "NOMBRE"=>["required","max:255"],
            "NOM_GRUPO_1"=>"sometimes|max:100",
            "NOM_GRUPO_2"=>"sometimes|max:100",
            "NOM_GRUPO_3"=>"sometimes|max:100",
            "NOM_GRUPO_4"=>"sometimes|max:100",
            "NOM_GRUPO_5"=>"sometimes|max:100",
        ];
        $reglas=[
            "NOMBRE.required"=>"Este campo es requerido",
            "NOMBRE.max"=>"Caracteres máximos: 255",
            "NOM_GRUPO_1.max"=>"Caracteres máximos: 100",
            "NOM_GRUPO_2.max"=>"Caracteres máximos: 100",
            "NOM_GRUPO_3.max"=>"Caracteres máximos: 100",
            "NOM_GRUPO_4.max"=>"Caracteres máximos: 100",
            "NOM_GRUPO_5.max"=>"Caracteres máximos: 100",
        ];
        
        $validator = \Validator::make($request->all(), $campos,$reglas);
        $error = $validator->errors()->toArray();
        
        if($error){
            return response()->json(["errors"=>$error]);
        }
      
      $pl = Plantillas_grupos::first();
      
      if($pl != null){
         
         $pl->NOMBRE = $request->get("NOMBRE");
         $pl->NOM_GRUPO_1 = $request->get("NOM_GRUPO_1");
         $pl->NOM_GRUPO_2 = $request->get("NOM_GRUPO_2");
         $pl->NOM_GRUPO_3 = $request->get("NOM_GRUPO_3");
         $pl->NOM_GRUPO_4 = $request->get("NOM_GRUPO_4");
         $pl->NOM_GRUPO_5 = $request->get("NOM_GRUPO_5");
         
         if($pl->save()){
            return json_encode(["resultado"=>"ok"]);
         }
         else{
            return json_encode(['resultado'=>"error",'mensaje'=>"Ocurrio un error, vuelva a cargar la página"]);
         }
         
      }
      else{
         $pl = new Plantillas_grupos();
         $pl->NOMBRE = $request->get("NOMBRE");
         $pl->NOM_GRUPO_1 = $request->get("NOM_GRUPO_1");
         $pl->NOM_GRUPO_2 = $request->get("NOM_GRUPO_2");
         $pl->NOM_GRUPO_3 = $request->get("NOM_GRUPO_3");
         $pl->NOM_GRUPO_4 = $request->get("NOM_GRUPO_4");
         $pl->NOM_GRUPO_5 = $request->get("NOM_GRUPO_5");
         
         if($pl->save()){
            return json_encode(["resultado"=>"ok"]);
         }
         else{
            return json_encode(['resultado'=>"error",'mensaje'=>"Ocurrio un error, vuelva a cargar la página"]);
         }
      }
      
    }
    
}
