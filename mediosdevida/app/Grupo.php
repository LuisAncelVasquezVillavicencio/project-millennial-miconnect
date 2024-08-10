<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Grupo extends Model
{
    //
    protected $table = 'tb_grupo';
    public $timestamps = true;
    protected $primaryKey = 'ID_GRUPO';
    
    public function contactos()
    {
        return $this->hasMany('App\Contacto','ID_GRUPO');
    }
     
    
    public function Eliminar_contactos_grupo($id){
        return DB::table('tb_contactos')->where('ID_GRUPO', '=', $id)->delete();  
    }
    public function Eliminar_grupo($id){
        return DB::table('tb_grupo')->where('ID_GRUPO', '=', $id)->delete();
    }
    
    public function Mensajes_validacion_grupo(){
        
        return $customMessages = [
            'TITULO.required' => '* El campo Titulo no pude estar vacio.',
            'DESCRIPCION.required' => '* El campo Descripción no pude estar vacio.',
            'NOM_GRUPO_1.required' => '* El campo Titulo grupo 1 no pude estar vacio.',
            'NOM_GRUPO_2.required' => '* El campo Titulo grupo 2 no pude estar vacio.',
            'NOM_GRUPO_3.required' => '* El campo Titulo grupo 3 no pude estar vacio.',
            'NOM_GRUPO_4.required' => '* El campo Titulo grupo 4 no pude estar vacio.',
            'NOM_GRUPO_5.required' => '* El campo Titulo grupo 5 no pude estar vacio.'
        ];
    
    }
    public function Campos_requeridos_grupo(){
    
        return $Validacion = [
         'TITULO'=>'required',
         'DESCRIPCION'=>'required',
         'NOM_GRUPO_1'=>'required',
        //  'NOM_GRUPO_2'=>'required',
        //  'NOM_GRUPO_3'=>'required',
        //  'NOM_GRUPO_4'=>'required',
        //  'NOM_GRUPO_5'=>'required'
        ];
    }
}
