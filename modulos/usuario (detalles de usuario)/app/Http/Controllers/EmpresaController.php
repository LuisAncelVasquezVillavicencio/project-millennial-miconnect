<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use App\Empresa;

class EmpresaController extends Controller
{
    /**
     * Obtener el objeto User como json
     */
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
