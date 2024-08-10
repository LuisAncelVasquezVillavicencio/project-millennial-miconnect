<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use App\Multimedia;

class MultimediaController extends Controller
{
    //
    public function index(Request $request){
       
      $items = Multimedia::orderBy("updated_at","desc")->get();
      
      if ($request->ajax()) {
            
            $nombre = $request->get("bus_name"); 
            $tipo = $request->get("bus_tipo");

            $items = Multimedia::whereRaw("TIPO like '".$tipo."%'")->whereRaw("NOMBRE_ORIGINAL like '".$nombre."%'")->orderBy("updated_at","desc")->get();
            
            return view("Multimedia.multimedia_lista",["items"=>$items])->render();
      }
      
      // return view("Multimedia.multimedia_index",["items"=>$items]);
      
      return view("Multimedia.multimedia_index",["items"=>$items]);
      
    }
    
    public function save(Request $request){
      
      $campos=[
         "tipo_archivo"=>["required","max:255"],
         "up_file"=>["required","mimes:jpeg,jpg,png,gif,mp4,pdf,doc,docx,xls,xlsx"]
      ];
      $reglas=[
         "tipo_archivo.required"=>"Este campo es requerido",
         "up_file.required"=>"Este campo es requerido",
         "up_file.mimes"=>"Formato de archivo"
      ];
     
      $validator = \Validator::make($request->all(), $campos,$reglas);
      $error = $validator->errors()->toArray();
     
      if($error){
         return response()->json(["errors"=>$error]);
      }
      
      $tipo = $request->get("tipo_archivo");
      
      $filename = "";
      $url = "";
      $filename = $request->file('up_file')->getClientOriginalName();
      $file = $request->file('up_file');   
      
      $foo = File::extension($filename);
      $nombre_final = $filename;
      
      $ubicacion = $file->move("storage/".$tipo."/", $nombre_final);
      $url = asset("storage/".$tipo."/".$nombre_final);

      $multinombre = Multimedia::where("NOMBRE_ARCHIVO","like",$nombre_final)->get();
      if(count($multinombre) == 0){
         
         $multimedia = new Multimedia();
   
         $multimedia->TIPO = $tipo;
         $multimedia->NOMBRE_ORIGINAL = $filename;
         $multimedia->NOMBRE_ARCHIVO = $nombre_final;
         $multimedia->FORMATO_ARCHIVO = $foo;
         $multimedia->UB_FISICA = $ubicacion;
         $multimedia->URL = $url;
   
         if($multimedia->save()){
            return response()->json(['resultado'=>"ok",'mensaje'=>"Se guardó correctamente"]);
         }
         else{
            return response()->json(['resultado'=>"error",'mensaje'=>"No se pudo guardar archivo"]);
         }
      }
      else{
         
         $media = Multimedia::where("NOMBRE_ARCHIVO","like",$nombre_final)->first();
         $media->updated_at = date("Y-m-d H:i:s");
         
         if($media->save()){
            return response()->json(['resultado'=>"ok",'mensaje'=>"Se actualizó correctamente"]); 
         }
         else{
            return response()->json(['resultado'=>"error",'mensaje'=>"No se pudo guardar archivo"]);
         }

      }

    }
    public function destroy(Request $request){
       
      $items = Multimedia::where("ID_MULTIMEDIA","=",$request->get("ID_MULTIMEDIA"))->first();
      $image_path = $items->UB_FISICA;
      
      if(File::exists($image_path)) {
         if(File::delete($image_path)){
            $eliminar = Multimedia::find($request->get("ID_MULTIMEDIA"));
            $eliminar->delete(); 
            $eliminar = Multimedia::where("NOMBRE_ARCHIVO","like",$eliminar->NOMBRE_ARCHIVO);
            $eliminar->delete(); 
            return response()->json(['resultado'=>"ok",'mensaje'=>"Se eliminó correctamente"]); 
         }
         else{
            return response()->json(['resultado'=>"error",'mensaje'=>"No se pudo eliminar archivo"]);
         }
      }
      else{
         return response()->json(['resultado'=>"error",'mensaje'=>"No se pudo eliminar archivo"]);
      }
       
       
      
    }
    public function show(Request $request){
       
      $items = Multimedia::where("ID_MULTIMEDIA","=",$request->get("idmulti"))->first();
      
      return view("Multimedia.multimedia_modal_show",["item"=>$items])->render();
      
    }
}
