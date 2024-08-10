<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Categorias;
use App\Grupo;

class CategoriasController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
       
       $categorias = Categorias::get();
       return view("Config.categorias",compact('categorias'));
    }
    
    public function store(Request $request){
       
       $campos=[
            "CATEGORIA"=>["required","max:255"],
        ];
        $reglas=[
            "CATEGORIA.required"=>"Este campo es requerido",
            "CATEGORIA.max"=>"Caracteres máximos: 255",
        ];
        
        $validator = \Validator::make($request->all(), $campos,$reglas);
        $error = $validator->errors()->toArray();
        
        if($error){
            return response()->json(["errors"=>$error]);
        }
       
       $categoria = $request->get("CATEGORIA");
       $cat = new Categorias();
       $cat->CATEGORIA = $categoria;
       
       if($cat->save()){
            return json_encode(["resultado"=>"ok"]);
        }
        else{
            return json_encode(['resultado'=>"error",'mensaje'=>"Ocurrio un error, vuelva a cargar la página"]);
        }
       
    }
    
    public function edit(Request $request){
       
      $data = Categorias::where('ID_CATEGORIA', $request->get('id'))->first();
      return response()->json($data);
    }
    
    public function update(Request $request){
       
       $campos=[
            "CATEGORIA_E"=>["required","max:255"],
        ];
        $reglas=[
            "CATEGORIA_E.required"=>"Este campo es requerido",
            "CATEGORIA_E.max"=>"Caracteres máximos: 255",
        ];
        
        $validator = \Validator::make($request->all(), $campos,$reglas);
        $error = $validator->errors()->toArray();
        
        if($error){
            return response()->json(["errors"=>$error]);
        }
       
       $categoria = $request->get("CATEGORIA_E");
       $cat = Categorias::find($request->get("ID_CATEGORIA_E"));
       $cat->CATEGORIA = $categoria;
       
       if($cat->save()){
            return json_encode(["resultado"=>"ok"]);
        }
        else{
            return json_encode(['resultado'=>"error",'mensaje'=>"Ocurrio un error, vuelva a cargar la página"]);
        }
       
    }
    
    public function destroy(Request $request){
        
        $categoria = Categorias::where("ID_CATEGORIA",$request->get('ID_CATEGORIA_EL'))->delete();
        
        $grupos = Grupo::where("ID_CATEGORIA",$request->get('ID_CATEGORIA_EL'))->update(["ID_CATEGORIA"=>null]);
        
        if($categoria){
            
            return response()->json(['resultado'=>"ok",'mensaje'=>"Se eliminó correctamente"]); 
        }
        else{
            return response()->json(['resultado'=>"error",'mensaje'=>"No se pudo eliminar grupo"]); 
        }
        
        
    }
}
