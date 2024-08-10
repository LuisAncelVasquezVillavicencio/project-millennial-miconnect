<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contacto;
use App\Grupo;
use App\Pais;
use Validator;
use Exception;
use Response;
use DB;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class ContactoController extends Controller
{
    //Edit 15/07/2020
    /*
        Autor: Jesús Salgado
        Se agrego metodos Trim para evitar espacios indeseados en store y Guardar_Masivo
    */
    
    
    public function show(Request $request){
        
        $grupos = Grupo::get();
        $pais = Pais::get();
        $p = $request->get("page");
        $b = $request->get("busqueda");
        $grupo_anterior = session("grupo_anterior") ;

        
        if($grupo_anterior == null){
            if(count($grupos)>0){
                $grupo_anterior = $grupos[0]->ID_GRUPO;   
            }
            else{
                $alerta = array();
                $alerta['notice']  = null;
                $alerta['warning'] = null;
                $alerta['error']   = null ;
                $grupo_anterior = -1;  
                return redirect(route("grupos",compact('grupo','alerta'))); 
            }

        }
        else{
            $importar = session("importar");
            
            if($importar != null){
               session()->forget('importar');
               session()->forget('grupo_anterior');
            }
        }
        
        if(isset($p)){
           if(!$request->ajax()){
                return redirect(route("contactos")); 
            } 
        }
        
        if(isset($b)){
           if(!$request->ajax()){
            return redirect(route("contactos")); 
            }  
        }
        
        $contactos = Contacto::where("ID_GRUPO",'=',$grupo_anterior)->orderBy('updated_at', 'desc')->paginate(10);

        
        if ($request->ajax()) {
            
            if(trim($request->busqueda) != ""){
                $busqueda = trim($request->busqueda);
                $grupo_selecionado = Grupo::withCount(['contactos'])->where("ID_GRUPO",'=',$request->grupo)->first();
                $contactos = Contacto::where("ID_GRUPO",'=',$request->grupo)->where(function($query) use ($busqueda) {
                    return $query
                    ->orWhere('NUMERO','like',$busqueda.'%')
                    ->orWhere(DB::raw("CONCAT(`NOMBRE`, ' ', `APELLIDO`)"),'like','%'.$busqueda.'%')
                    ->orWhere(DB::raw("CONCAT(`APELLIDO`, ' ', `NOMBRE`)"),'like','%'.$busqueda.'%');
                })->orderBy('updated_at', 'desc')->paginate(10);
            }
            else{
                $grupo_selecionado = Grupo::withCount(['contactos'])->where("ID_GRUPO",'=',$request->grupo)->first();
                $contactos = Contacto::where("ID_GRUPO",'=',$request->grupo)->orderBy('updated_at', 'desc')->paginate(10); 
            }
           
            return view('Contacto.contactos_grupo',['contactos_grupo'=>$contactos,'grupos'=>$grupos,'pais'=>$pais,'grupo_old' => $request->grupo,"grupo_selecionado"=>$grupo_selecionado])->render();  
        }
        
        
        $grupo_selecionado = Grupo::withCount(['contactos'])->where("ID_GRUPO",'=',$grupo_anterior)->first();
        return view('Contacto.contactos',['contactos_grupo'=>$contactos,'grupos'=>$grupos,'pais'=>$pais,'grupo_old'=> $grupo_anterior,"grupo_selecionado"=>$grupo_selecionado]);
    }
    public function store(Request $request){
        
        $Contacto = new Contacto();
        $id_contacto = $request->get("ID_C");
        
        $this->validate($request,$Contacto->Campos_requeridos_contacto($request->get('GRUPO')),$Contacto->Mensajes_validacion_contacto($request->get('GRUPO')));
        
        if($id_contacto=="0"){
            
            $Contacto = new Contacto();
        
            $Contacto->ID_WASSAP = "1";
            $Contacto->ID_PAIS = $request->get('PAIS');
            $Contacto->ID_GRUPO = $request->get('GRUPO');
            $Contacto->NUMERO =  trim($request->get('NUMERO'));
            $Contacto->NOMBRE = trim($request->get('NOMBRE_CONTACTO'));
            $Contacto->APELLIDO = trim($request->get('APELLIDO_CONTACTO'));
            $Contacto->VAL_GRUPO1 =  trim($request->get('VAL_GRUPO1'));
            $Contacto->VAL_GRUPO2 =  trim($request->get('VAL_GRUPO2'));
            $Contacto->VAL_GRUPO3 =  trim($request->get('VAL_GRUPO3'));
            $Contacto->VAL_GRUPO4 =  trim($request->get('VAL_GRUPO4'));
            $Contacto->VAL_GRUPO5 =  trim($request->get('VAL_GRUPO5'));
            
            
           if($Contacto->save()){
              return json_encode(["message"=>"Se guardó correctamente"]);
           }
           else{
              return json_encode(["message"=>"Ocurrió un error"]);
           }    
        
        }
        else{
            
          $Contacto = Contacto::find($id_contacto);
          
          if($Contacto==null)
          {
            return json_encode(["message"=>"Ocurrio un error, no se puede actualizar este contacto"]);
          }
          
          $Contacto->ID_WASSAP = "1";
          $Contacto->ID_PAIS = $request->get('PAIS');
          $Contacto->ID_GRUPO = $request->get('GRUPO');
          $Contacto->NUMERO =  trim($request->get('NUMERO'));
          $Contacto->NOMBRE = trim($request->get('NOMBRE_CONTACTO'));
          $Contacto->APELLIDO = trim($request->get('APELLIDO_CONTACTO'));
          $Contacto->VAL_GRUPO1 =  trim($request->get('VAL_GRUPO1'));
          $Contacto->VAL_GRUPO2 =  trim($request->get('VAL_GRUPO2'));
          $Contacto->VAL_GRUPO3 =  trim($request->get('VAL_GRUPO3'));
          $Contacto->VAL_GRUPO4 =  trim($request->get('VAL_GRUPO4'));
          $Contacto->VAL_GRUPO5 =  trim($request->get('VAL_GRUPO5'));
          
          
          if($Contacto->save()){
              return json_encode(["message"=>"Se actualizó correctamente"]);
           }
          else{
              return json_encode(["message"=>"Ocurrió un error"]);
           }  
        }
        
        
    }
    public function destroy(Request $request){
        
        $id_contacto = $request->get("id");
        $Mensaje = Contacto::where('ID_CONTACTO',$id_contacto)->delete();
        if($Mensaje){
            
            $array_respuesta = array("mensaje" => "Se elimino contacto correctamente");
        
            return json_encode($array_respuesta);
        }
        else{
            $array_respuesta = array("mensaje" => "Hubo un problema, No se pudo eliminar contacto");
        
            return json_encode($array_respuesta);
        }
        
        
    }
    public function modal_contacto(Request $request){
        
        $id = $request->get("id");
        $grupo_actual = $request->get("grupo");

        $contactos = new Contacto();
        $array = $contactos->Modal($id);
        $pais = Pais::get();
        $grupos = Grupo::get();
        
        return view("Contacto.contactos_sub.contactos_modal",["datos_modal"=>$array,'pais'=>$pais,'grupos'=>$grupos,'grupo_actual' => $grupo_actual])->render(); 
       
    }
    public function Obtener_campos(Request $request){
        
        $contactos = new Contacto();
        $id = $request->get("id");
        $id_grupo = $request->get("grupo");
        $array = $contactos->Modal($id);
        $grupos = Grupo::where("id_grupo","=",$id_grupo)->get();
        return view("Contacto.contactos_sub.contactos_modal_sub",["datos_modal"=>$array,'grupos'=>$grupos,'$grupo'=>$id_grupo])->render();
    }
    public function import(Request $request){
        
        $grupo_consulta = $request->get("combo_grupo");
        
        $grupos = Grupo::get();
        $pagina = $request->get("page");
        $contactos = new Contacto();
        
        if(!isset($pagina))
        {
          session()->forget('data_csv');
        }
        else if(!$request->ajax()){
           return redirect(route("importar_contacto")); 
        }
        
        if($request->ajax()){
    
            return $this->up_file($request);
        }
        
        return view("Contacto.contactos_importar",['grupos'=>$grupos,"grupo_consultado"=>$grupo_consulta]);
    }
    public function up_file(Request $request){
        
        // dd($request->get("combo_grupo"));
         $contactos = new Contacto();
         $grupo = $request->get("combo_grupo");
         $grupo_busqueda = Grupo::where('ID_GRUPO','=',$grupo)->first();
         if($request->hasFile("up_file")){
            
            $filename = $request->file('up_file')->getClientOriginalName();
            
            $data = array();
            try{
                $data = $contactos->Leer_csv($request);
            }
            catch(Exception $e){
                $validado = "0";
                return view("Contacto.contactos_importar_vista",["error"=>"El csv no tiene el formato correcto","validado"=>$validado])->render();
            };
            $validado = "0";
            if(count($data)>0){
                $validado = "1";
            }
            $Error = $contactos->Validar($data,$grupo);
            if(count($Error)>0){
                $validado = "0"; 
            }
            
            session(['data_csv'=> $data]);
            session(['validado'=> $validado]);

            $data_b = $contactos->paginar_array($data,route("importar_contacto"),$request->query());
            if(count($Error)>0){
                return view("Contacto.contactos_importar_vista",["csv_data"=>$data_b,"validado"=>$validado,"lista_error"=>$Error])->render(); 
            }
            else{
                return view("Contacto.contactos_importar_vista",["csv_data"=>$data_b,"validado"=>$validado,"grupo_busqueda"=>$grupo_busqueda])->render(); 
            }
         }
         else{
             
             $data_csv = session('data_csv');
             $validado = session('validado');
             
             if(!isset($data_csv)){
                $data_csv = [];
                $validado = "0";
             }
             
             $data_b=$contactos->paginar_array($data_csv,route("importar_contacto"),$request->query()); 
             
             return view("Contacto.contactos_importar_vista",["csv_data"=>$data_b,"validado"=>$validado,"grupo_busqueda"=>$grupo_busqueda])->render();
         }
    }
    public function descarga_modelo(Request $request){
        
        // $contacto = new Contacto();
        // return $contacto->Crear_csv_modelo($request->get("grupo"));
    }
    public function Guardar_masivo(Request $request){
        
        $data_csv = session('data_csv');
        $mensajesError = [];
        $incorrecto = [];
        $grupo = $request->get("grupo");
        $now = Carbon::now('utc')->toDateTimeString();
        $dataSet = [];
        $paises = PAIS::get();

        if(isset($data_csv)){
            foreach($data_csv as $linea) {
            
            $id_pais = null;
            foreach($paises as $pais){
                if(trim($linea["PAIS"]) == trim($pais->COD_TEL_PAIS)){
                    $id_pais = $pais->ID_PAIS;
                }
            }
   
            $dataSet[] = [
                'ID_WASSAP'=> "1",
                'ID_PAIS'=>  $id_pais,
                'ID_GRUPO'=> $grupo,
                'NUMERO'=>  trim($linea["NUMERO"]) ,
                'NOMBRE'=>  trim($linea["NOMBRE_CONTACTO"]) ,
                'APELLIDO' =>  trim($linea["APELLIDO_CONTACTO"]) ,
                'VAL_GRUPO1' => (isset($linea["VAL_GRUPO1"]) ? trim($linea["VAL_GRUPO1"]) : ""),
                'VAL_GRUPO2' => (isset($linea["VAL_GRUPO2"]) ? trim($linea["VAL_GRUPO2"]) : ""),
                'VAL_GRUPO3' => (isset($linea["VAL_GRUPO3"]) ? trim($linea["VAL_GRUPO3"]) : ""),
                'VAL_GRUPO4' => (isset($linea["VAL_GRUPO4"]) ? trim($linea["VAL_GRUPO4"]) : ""),
                'VAL_GRUPO5' => (isset($linea["VAL_GRUPO5"]) ? trim($linea["VAL_GRUPO5"]) : ""),
                'created_at'=> $now,
                'updated_at'=> $now
                ];
            };   
        }
        try{
            foreach (array_chunk($dataSet,1000) as $t)  
            {
                 DB::table('tb_contactos')->insert($t); 
            }
        }
        catch(QueryException $e){
            array_push($mensajesError,$e->getMessage());
        };
        
        session(["grupo_anterior" => $grupo ]) ;
        session(["importar"=>true]);
        return view("Contacto.contactos_importar_vista",["Incorrecto"=>$incorrecto,"Correcto"=>"Se importo correctamente.","mensajesError"=>$mensajesError])->render();

    }
}
