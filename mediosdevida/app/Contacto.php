<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Pais;
use App\Grupo;

class Contacto extends Model
{
    //

    protected $table = 'tb_contactos';
    public $timestamps = true;
    protected $primaryKey = 'ID_CONTACTO';
    
    public function Mensajes_validacion_contacto($GRUPO){
        
        $Grupo_b = Grupo::where("ID_GRUPO","=",$GRUPO)->first();        
        $customMessages = [
            'NOMBRE_CONTACTO.required' => '* El campo Nombre no pude estar vacio.',
            'NOMBRE_CONTACTO.max' => '* El campo Nombre no puede ser mayor a 255 caracteres.',
            //'APELLIDO_CONTACTO.required' => '* El campo Apellido no pude estar vacio.',
            'APELLIDO_CONTACTO.max' => '* El campo Apellido no puede ser mayor a 255 caracteres.',
            'NUMERO.required' => '* El campo Número no pude estar vacio.',
            'NUMERO.max' => '* El campo Numero no puede ser mayor a 15 caracteres.',
            'NUMERO.unique'=>'* El numero ya existe en este grupo.',
            'PAIS.required' => '* El campo Pais no pude estar vacio.',
            'GRUPO.required' => '* El campo Grupo no pude estar vacio.'
        ];
        
        $valor1 = $Grupo_b->NOM_GRUPO_1;
        $valor2 = $Grupo_b->NOM_GRUPO_2;
        $valor3 = $Grupo_b->NOM_GRUPO_3;
        $valor4 = $Grupo_b->NOM_GRUPO_4;
        $valor5 = $Grupo_b->NOM_GRUPO_5;
        
        if($valor1 != ""){
           $customMessages += ['VAL_GRUPO1.required' => '* El campo '.$valor1.' no pude estar vacio.'];
           $customMessages += ['VAL_GRUPO1.max' => '* El campo '.$valor1.' no puede ser mayor a 255 caracteres.'];
        }
        if($valor2 != ""){
           $customMessages += ['VAL_GRUPO2.required' => '* El campo '.$valor2.' no pude estar vacio.'];
           $customMessages += ['VAL_GRUPO2.max' => '* El campo '.$valor2.' no puede ser mayor a 255 caracteres.'];
        }
        if($valor3 != ""){
           $customMessages += ['VAL_GRUPO3.required' => '* El campo '.$valor3.' no pude estar vacio.'];
           $customMessages += ['VAL_GRUPO3.max' => '* El campo '.$valor3.' no puede ser mayor a 255 caracteres.'];
        }
        if($valor4 != ""){
           $customMessages += ['VAL_GRUPO4.required' => '* El campo '.$valor4.' no pude estar vacio.'];
           $customMessages += ['VAL_GRUPO4.max' => '* El campo '.$valor5.' no puede ser mayor a 255 caracteres.'];
        }
        if($valor5 != ""){
           $customMessages += ['VAL_GRUPO5.required' => '* El campo '.$valor5.' no pude estar vacio.'];
           $customMessages += ['VAL_GRUPO5.max' => '* El campo '.$valor5.' no puede ser mayor a 255 caracteres.'];
        }
        
        return $customMessages;
    
    }
    public function Campos_requeridos_contacto($GRUPO){
        
        $Grupo_b = Grupo::where("ID_GRUPO","=",$GRUPO)->first();
        $Validacion = ['NOMBRE_CONTACTO'=>'required|max:255',
         'APELLIDO_CONTACTO'=>'max:255',
         'NUMERO'=>'required|max:15',
         'PAIS'=>'required',
         'GRUPO'=>'required'];
    
         
        $valor1 = $Grupo_b->NOM_GRUPO_1;
        $valor2 = $Grupo_b->NOM_GRUPO_2;
        $valor3 = $Grupo_b->NOM_GRUPO_3;
        $valor4 = $Grupo_b->NOM_GRUPO_4;
        $valor5 = $Grupo_b->NOM_GRUPO_5;
        
        if($valor1 != ""){
           $Validacion += ['VAL_GRUPO1'=>'required'];
        }
        if($valor2 != ""){
           $Validacion += ['VAL_GRUPO2'=>'required'];
        }
        if($valor3 != ""){
           $Validacion += ['VAL_GRUPO3'=>'required'];
        }
        if($valor4 != ""){
           $Validacion += ['VAL_GRUPO4'=>'required'];
        }
        if($valor5 != ""){
           $Validacion += ['VAL_GRUPO5'=>'required'];
        }
    
        return $Validacion;
    }
    /*
    *
    * Luis Ancel Vasquez
    * Relacion con pais eloquent
    */
    public function pais(){
    	return $this->hasOne(Pais::class, 'ID_PAIS', 'ID_PAIS');
    }
    /*
    *
    * Luis Ancel Vasquez
    * Relacion con grupo eloquent
    */
    public function grupo(){
    	return $this->hasOne(Grupo::class, 'ID_GRUPO', 'ID_GRUPO');
    }
    
    public function Modal($id){
        
        $contacto = Contacto::where("ID_CONTACTO","=",$id)->get();

        if(count($contacto)>0){
            
            $data = array(
                [
                    "id"=>$contacto[0]->ID_CONTACTO,
                    "id_pais" => $contacto[0]->ID_PAIS,
                    "id_grupo" => $contacto[0]->ID_GRUPO,
                    "numero_celular" => $contacto[0]->NUMERO,
                    "nombre_contacto" => $contacto[0]->NOMBRE,
                    "apellido" => $contacto[0]->APELLIDO,
                    "val_grupo1" => $contacto[0]->VAL_GRUPO1,
                    "val_grupo2" => $contacto[0]->VAL_GRUPO2,
                    "val_grupo3" => $contacto[0]->VAL_GRUPO3,
                    "val_grupo4" => $contacto[0]->VAL_GRUPO4,
                    "val_grupo5" => $contacto[0]->VAL_GRUPO5,
                    "titulo"=>"Editar contacto"
                ]
                );

            return ($data);
        }
        else{
           $data = array([                    
                    "id"=>"0",
                    "id_pais" => "0",
                    "id_grupo" => "0",
                    "numero_celular" => "",
                    "nombre_contacto" =>"",
                    "apellido" => "",
                    "val_grupo1" => "",
                    "val_grupo2" => "",
                    "val_grupo3" => "",
                    "val_grupo4" => "",
                    "val_grupo5" => "",
                    "titulo"=>"Crear contacto"
                    ]);
           return ($data);
        }
        
    }
    
   /*
   Edit: 15/07/2020
   Se agrego Trim para evitar espacios indeseados en filtro
   */ 
    
    public function Obtener_contactos_multi_filtro(Request $request){
        
        $all = $request->all();
        
        $query = "select * from tb_contactos where ID_GRUPO = '".$request->get("id_grupo")."'";
        
        $array1 = [];
        $array2 = [];
        $array3 = [];
        $array4 = [];
        $array5 = [];
        
        
        foreach ($all as $clave => $valor) {
            if(!($clave=='_token' or $clave=='id_grupo')){
               $i = intval(substr($clave, 0, 1));
               switch ($i) {
                  case 1:
                     array_push($array1,$valor);
                      break;
                  case 2:
                     array_push($array2,$valor);
                      break;
                  case 3:
                     array_push($array3,$valor);
                      break;
                  case 4:
                     array_push($array4,$valor);
                      break;
                  case 5:
                     array_push($array5,$valor);
                      break;
               }
            }
        }
        
        $array1 = "'".join("','",$array1)."'";
        $array2 = "'".join("','",$array2)."'";
        $array3 = "'".join("','",$array3)."'";
        $array4 = "'".join("','",$array4)."'";
        $array5 = "'".join("','",$array5)."'";
        
        if($array1 == "''"){
            $array1 = "VAL_GRUPO1";
        }
        
        if($array2 == "''"){
            $array2 = "VAL_GRUPO2";
        }
        
        if($array3 == "''"){
            $array3 = "VAL_GRUPO3";
        }
        
        if($array4 == "''"){
            $array4 = "VAL_GRUPO4";
        }
        
        if($array5 == "''"){
            $array5 = "VAL_GRUPO5";
        }
        
        $query = "select * from tb_contactos where ID_GRUPO = '".$request->get("id_grupo")
        ."' and ((TRIM(VAL_GRUPO1) in (".trim($array1).") or VAL_GRUPO1 is null)  and (TRIM(VAL_GRUPO2) in (".trim($array2).") or VAL_GRUPO2 is null) and (TRIM(VAL_GRUPO3) in (".trim($array3).") or VAL_GRUPO3 is null)" 
        ." and (TRIM(VAL_GRUPO4) in (".trim($array4).") or VAL_GRUPO4 is null) and (TRIM(VAL_GRUPO5) in (".trim($array5).") or VAL_GRUPO5 is null)) order by updated_at desc";
        
        
        
        $result =  DB::select(DB::raw($query));
        $result_ = Contacto::hydrate($result);
        return($result_);
        
    }
    public function paginar_array($items,$url,$query, $perPage = 10, $page = null, $options = []){
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, ['path' => $url, 'query' =>$query ]);
    }
    public function Leer_csv(Request $request){
       
       $data =array();
       $grupo = $request->get("combo_grupo");
       $header = null;
       
        $delimiters = array(
            ';' => 0,
            ',' => 0,
            "\t" => 0,
            "|" => 0
        );
    
        $handle = fopen($request->file('up_file'), "r");
        $firstLine = fgets($handle);
        fclose($handle); 
        foreach ($delimiters as $delimiter => &$count) {
            $count = count(str_getcsv($firstLine, $delimiter));
        }
        
        $separador = array_search(max($delimiters), $delimiters);
       
       
       if (($handle = fopen($request->file('up_file'), 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $separador)) !== false)
            {
                if (!$header){
                    $header[0] = $row[0];
                    $header[1] = $row[1];
                    $header[2] = $row[2];
                    $header[3] = $row[3];
                    
                    if(!isset($row[4])){
                        $header[4] = "";
                    }
                    else{
                        $header[4] = $row[4];
                    }
                    if(!isset($row[5])){
                       $header[5] = "";
                    }
                    else{
                        $header[5] = $row[5];
                    }
                    if(!isset($row[6])){
                        $header[6] = "";
                    }
                    else{
                        $header[6] = $row[6];
                    }
                    if(!isset($row[7])){
                        $header[7] = "";
                    }
                    else{
                        $header[7] = $row[7];
                    }
                    if(!isset($row[8])){
                        $header[8] = "";
                    }
                    else{
                        $header[8] = $row[8];
                    }
                }
                else{
                    $header[0] = "PAIS";
                    $header[1] = "NUMERO";
                    $header[2] = "NOMBRE_CONTACTO";
                    $header[3] = "APELLIDO_CONTACTO";
                    $header[4] = "VAL_GRUPO1";
                    $header[5] = "VAL_GRUPO2";
                    $header[6] = "VAL_GRUPO3";
                    $header[7] = "VAL_GRUPO4";
                    $header[8] = "VAL_GRUPO5";
                    
                    if(!isset($row[4])){
                       $row[4]  = "";
                    }
                    if(!isset($row[5])){
                       $row[5]  = "";
                    }
                    if(!isset($row[6])){
                       $row[6]  = "";
                    }
                    if(!isset($row[7])){
                       $row[7]  = "";
                    }
                    if(!isset($row[8])){
                       $row[8]  = "";
                    }
                     
                    $data[] = array_combine($header, $row);
                }
                    
            }
            
            fclose($handle);
        }
        if(!mb_check_encoding($data, 'UTF-8')){
            $data = mb_convert_encoding($data, 'UTF-8');
        }
        return $data;
        
    }
    public function Validar($data,$id_grupo){
        
        $validado = "1";
        $datos = [];
        $grupos = []; 
        $i = 1;
        
        $paises = PAIS::get();
        
        if(!Grupo::where('ID_GRUPO','=',$id_grupo)->exists()){
            array_push($datos,"El grupo seleccionado no es valido");   
            return $datos;
        }
        else{
            $grupos = Grupo::where('ID_GRUPO','=',$id_grupo)->get();
        }
        
                
        foreach($data as $linea){
            $numero = $linea["NUMERO"];
            $cadena = "";
            
            // if (Contacto::where('NUMERO', '=',$numero)->where('ID_GRUPO','=',$id_grupo)->exists()) {
            //     $cadena = $cadena."El numero ya existe en el grupo. ";
            // }
            if(trim($linea["PAIS"]) == ""){
                $cadena = $cadena."No se encontro valor en la columna CÓDIGO PAÍS. ";  
            }
            else{
                $counter = 0;
                foreach($paises as $pais){
                    if($linea["PAIS"] == $pais->COD_TEL_PAIS){
                        $counter ++;
                    }
                }
                if($counter == 0){
                    $cadena = $cadena."El valor '".$linea["PAIS"]."' no es un valor valido para la columna CÓDIGO PAÍS. ";
                }
            }
            if(trim($numero) == ""){
                $cadena = $cadena."No se encontro valor en la columna NÚMERO CELULAR. ";
            }
            else{
                if(strlen($linea["NUMERO"])>15){
                  $cadena = $cadena."El valor '".$linea["NUMERO"]."' es muy largo para la columna NÚMERO CELULAR. ";   
                }
            }
            if(trim($linea["NOMBRE_CONTACTO"])==""){
                $cadena = $cadena."No se encontro valor en la columna NOMBRE. "; 
            }
            else{
                if(strlen($linea["NOMBRE_CONTACTO"])>255){
                  $cadena = $cadena."El valor '".$linea["NOMBRE_CONTACTO"]."' es muy largo para la columna NOMBRE. ";   
                }
            }
            if(trim($linea["APELLIDO_CONTACTO"])==""){
                // $cadena = $cadena."No se encontro valor en la columna APELLIDO. ";
            }
            else{
                if(strlen($linea["APELLIDO_CONTACTO"])>255){
                  $cadena = $cadena."El valor '".$linea["APELLIDO_CONTACTO"]."' es muy largo para la columna APELLIDO. ";   
                }
            }
            
            $val1 = $grupos[0]->NOM_GRUPO_1;
            $val2 = $grupos[0]->NOM_GRUPO_2;
            $val3 = $grupos[0]->NOM_GRUPO_3;
            $val4 = $grupos[0]->NOM_GRUPO_4;
            $val5 = $grupos[0]->NOM_GRUPO_5;
            
            if($val1 != null && trim($val1) != ""){
                if(trim($linea["VAL_GRUPO1"])==""){
                $cadena = $cadena."No se encontro valor en la columna ".$val1.". ";
                }
                else{
                    if(strlen($linea["VAL_GRUPO1"])>500){
                      $cadena = $cadena."El valor es muy largo para la columna ".$val1.". ";   
                    }
                }
            }
            if($val1 != null && trim($val2) != ""){
                if(trim($linea["VAL_GRUPO2"])==""){
                $cadena = $cadena."No se encontro valor en la columna ".$val2.". ";
                }
                else{
                    if(strlen($linea["VAL_GRUPO2"])>500){
                      $cadena = $cadena."El valor es muy largo para la columna ".$val2.". ";   
                    }
                }
            }
            if($val1 != null && trim($val3) != ""){
                if(trim($linea["VAL_GRUPO3"])==""){
                $cadena = $cadena."No se encontro valor en la columna ".$val3.". ";
                }
                else{
                    if(strlen($linea["VAL_GRUPO3"])>500){
                      $cadena = $cadena."El valor es muy largo para la columna ".$val3.". ";   
                    }
                }
            }
            if($val1 != null && trim($val4) != ""){
                if(trim($linea["VAL_GRUPO4"])==""){
                $cadena = $cadena."No se encontro valor en la columna ".$val4.". ";
                }
                else{
                    if(strlen($linea["VAL_GRUPO4"])>500){
                      $cadena = $cadena."El valor es muy largo para la columna ".$val4.". ";   
                    }
                }
            }
            if($val1 != null && trim($val5) != ""){
                if(trim($linea["VAL_GRUPO5"])==""){
                $cadena = $cadena."No se encontro valor en la columna ".$val5.". ";
                }
                else{
                    if(strlen($linea["VAL_GRUPO5"])>500){
                      $cadena = $cadena."El valor es muy largo para la columna ".$val5.". ";   
                    }
                }
            }
            
            if($cadena != ""){
              $cadena = "Error en la linea ".($i+1).": ".$cadena;
              array_push($datos,$cadena);
            }
            $i++;
        }
        
        return $datos;
    }
    public function Crear_csv_modelo($id_grupo){
        
        // $contactos = Contacto::where("ID_GRUPO","=",-1)->join('tb_pais','tb_pais.ID_PAIS','=','tb_contactos.ID_PAIS')->get();
        // $grupo_data = Grupo::where("ID_GRUPO","=",$id_grupo)->get()->first();
        
        // $cabeceras = ['NOMBRE_PAIS'=>'id Pais','NUMERO'=>"Numero celular", 'NOMBRE'=>"Nombre","APELLIDO"=>"Apellido"];
        
        // if($grupo_data->NOM_GRUPO_1 != ""){
        //     $cabeceras+=['VAL_GRUPO1'=> $grupo_data->NOM_GRUPO_1];
        // }
        // if($grupo_data->NOM_GRUPO_2 != ""){
        //     $cabeceras+=['VAL_GRUPO2'=> $grupo_data->NOM_GRUPO_2];
        // }
        // if($grupo_data->NOM_GRUPO_3 != ""){
        //     $cabeceras+=['VAL_GRUPO3'=> $grupo_data->NOM_GRUPO_3];
        // }
        // if($grupo_data->NOM_GRUPO_4 != ""){
        //     $cabeceras+=['VAL_GRUPO4'=> $grupo_data->NOM_GRUPO_4];
        // }
        // if($grupo_data->NOM_GRUPO_5 != ""){
        //     $cabeceras+=['VAL_GRUPO5'=> $grupo_data->NOM_GRUPO_5];
        // }
        // $csvExporter = new \Laracsv\Export();
        
        // return $csvExporter->build($contactos, $cabeceras )->download("Modelo_grupo_".$grupo_data->TITULO.".csv"); 

    }
}
