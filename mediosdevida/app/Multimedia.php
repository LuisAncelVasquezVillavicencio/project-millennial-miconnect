<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Multimedia extends Model
{
    //
    protected $table = 'tb_multimedia';
    public $timestamps = true;
    protected $primaryKey = 'ID_MULTIMEDIA';
    
    public function Obtener_medios_multi_filtro(Request $request){
    
        $all = $request->all();
        
        $query = "select * from tb_multimedia";
        
        $array1 = [];
    
        foreach ($all as $clave => $valor) {
            if(!($clave=='_token')){
               $i = intval(substr($clave, 0, 1));
               switch ($i) {
                  case 1:
                     array_push($array1,$valor);
                      break;
               }
            }
        }
        
        $array1 = "'".join("','",$array1)."'";
    
        
        if($array1 == "''"){
            $array1 = "TIPO";
        }
    
        
        $query = "select * from tb_multimedia where "
        ."TIPO in (".$array1.") order by updated_at desc";
        
        
        
        $result =  DB::select(DB::raw($query));
        $result_ = Multimedia::hydrate($result);
        
        return($result_);
        
    }
}
