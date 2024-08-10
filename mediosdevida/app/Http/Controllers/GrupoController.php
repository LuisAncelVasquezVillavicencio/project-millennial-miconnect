<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupo;
use Validator;
use Auth;
use App\Categorias;
use App\Plantillas_grupos;

class GrupoController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //
    public function show(Request $request){
        
        // $Grupo = new Grupo();
        // $data = Grupo::withCount(['contactos'])->orderBy('updated_at', 'desc')->paginate(9);
        // if($request->ajax()){
        //     return view('Grupos.grupos_lista',['data'=>$data])->render();
        // }
        
        $categorias = Categorias::with(['grupos'])->get();
        $count_grupos = Grupo::whereNull("ID_CATEGORIA")->orWhere("ID_CATEGORIA","")->count();
        $plantillas = Plantillas_grupos::first();
        
        return view('Grupos.grupo_index',compact("categorias","count_grupos","plantillas"));
        
        //return view('Grupos.grupos',['data'=>$data]);
    }
    
    public function show_groups(Request $request){
        
        $titulo_cat = "Grupos sin asignar";
        
        if($request->id == 'no-asignado'){
            
            $grupos = Grupo::withCount(['contactos'])->whereNull("ID_CATEGORIA")->orWhere("ID_CATEGORIA","")->get();
        }
        else{
            $grupos = Grupo::withCount(['contactos'])->Where("ID_CATEGORIA",$request->id)->get();
            
            $categoria = Categorias::find($request->id);
            $titulo_cat = $categoria->CATEGORIA;
        }
        $categorias = Categorias::get();
        
        
        return view('Grupos.grupo_index_b',compact('grupos','titulo_cat','categorias'));
        
    }
    
    public function create(){
        
        return view('Grupos.grupos_sub.grupo_modal',['condicion'=>"crear"]);
        
    }
    public function edit($id){
        
        $data = Grupo::where('ID_GRUPO', $id)->first();
        return response()->json($data);
        
    }
    public function store(Request $request){
        
        $campos=[
            "TITULO"=>["required","max:255"],
            "DESCRIPCION"=>"required|max:500",
            "NOM_GRUPO_1"=>"sometimes|max:100",
            "NOM_GRUPO_2"=>"sometimes|max:100",
            "NOM_GRUPO_3"=>"sometimes|max:100",
            "NOM_GRUPO_4"=>"sometimes|max:100",
            "NOM_GRUPO_5"=>"sometimes|max:100",
            "ID_CATEGORIA"=>"required",
        ];
        $reglas=[
            "TITULO.required"=>"Este campo es requerido",
            "DESCRIPCION.required"=>"Este campo es requerido",
            "ID_CATEGORIA.required"=>"Este campo es requerido",
            "TITULO.max"=>"Caracteres máximos: 255",
            "DESCRIPCION.max"=>"Caracteres máximos: 500",
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
        
        $Grupo = new Grupo;
        $Grupo->TITULO = $request->get("TITULO");
        $Grupo->DESCRIPCION = $request->get("DESCRIPCION");
        $Grupo->NOM_GRUPO_1 = $request->get("NOM_GRUPO_1");
        $Grupo->NOM_GRUPO_2 = $request->get("NOM_GRUPO_2");
        $Grupo->NOM_GRUPO_3 = $request->get("NOM_GRUPO_3");
        $Grupo->NOM_GRUPO_4 = $request->get("NOM_GRUPO_4");
        $Grupo->NOM_GRUPO_5 = $request->get("NOM_GRUPO_5");
        $Grupo->ID_CATEGORIA = $request->get("ID_CATEGORIA");
        
        if($Grupo->save()){
            return json_encode(["resultado"=>"ok"]);
        }
        else{
            return json_encode(['resultado'=>"error",'mensaje'=>"Ocurrio un error, vuelva a cargar la página"]);
        }
            
        
    }
    public function update(Request $request){
        
        $id = $request->get("ID_GRUPO_E");
        
        $campos=[
            "TITULO_E"=>["required","max:255"],
            "DESCRIPCION_E"=>"required|max:500",
            "NOM_GRUPO_1_E"=>"sometimes|max:100",
            "NOM_GRUPO_2_E"=>"sometimes|max:100",
            "NOM_GRUPO_3_E"=>"sometimes|max:100",
            "NOM_GRUPO_4_E"=>"sometimes|max:100",
            "NOM_GRUPO_5_E"=>"sometimes|max:100",
            "ID_CATEGORIA_E"=>"required",
        ];
        $reglas=[
            "TITULO_E.required"=>"Este campo es requerido",
            "DESCRIPCION_E.required"=>"Este campo es requerido",
            "ID_CATEGORIA_E.required"=>"Este campo es requerido",
            "TITULO_E.max"=>"Caracteres máximos: 255",
            "DESCRIPCION_E.max"=>"Caracteres máximos: 500",
            "NOM_GRUPO_1_E.max"=>"Caracteres máximos: 100",
            "NOM_GRUPO_2_E.max"=>"Caracteres máximos: 100",
            "NOM_GRUPO_3_E.max"=>"Caracteres máximos: 100",
            "NOM_GRUPO_4_E.max"=>"Caracteres máximos: 100",
            "NOM_GRUPO_5_E.max"=>"Caracteres máximos: 100",
        ];
        
        $validator = \Validator::make($request->all(), $campos,$reglas);
        $error = $validator->errors()->toArray();
        
        if($error){
            return response()->json(["errors"=>$error]);
        }
        
        $Grupo = Grupo::find($id);
            
        if($Grupo==null){
           return response()->json(['resultado'=>"error",'mensaje'=>"El grupo no existe"]);
        }
        else{
            
            $Grupo->TITULO = $request->get("TITULO_E");
            $Grupo->DESCRIPCION = $request->get("DESCRIPCION_E");
            $Grupo->NOM_GRUPO_1 = $request->get("NOM_GRUPO_1_E");
            $Grupo->NOM_GRUPO_2 = $request->get("NOM_GRUPO_2_E");
            $Grupo->NOM_GRUPO_3 = $request->get("NOM_GRUPO_3_E");
            $Grupo->NOM_GRUPO_4 = $request->get("NOM_GRUPO_4_E");
            $Grupo->NOM_GRUPO_5 = $request->get("NOM_GRUPO_5_E");
            $Grupo->ID_CATEGORIA = $request->get("ID_CATEGORIA_E");    
            
            if($Grupo->save()){
                return json_encode(["resultado"=>"ok"]);
            }
            else{
                return json_encode(['resultado'=>"error",'mensaje'=>"Ocurrio un error, vuelva a cargar la página"]);
            }
            
        }
        
    }
    public function destroy(Request $request){
        
        $Grupo = new Grupo();
        $id_grupo = $request->get("ID_GRUPO_EL");
        $Contactos = $Grupo->Eliminar_contactos_grupo($id_grupo);
        $Mensaje = $Grupo->eliminar_grupo($id_grupo);
        
        if($Mensaje){
            
            return response()->json(['resultado'=>"ok",'mensaje'=>"Se eliminó correctamente"]); 
        }
        else{
            return response()->json(['resultado'=>"error",'mensaje'=>"No se pudo eliminar grupo"]); 
        }
        
        
    }
}
