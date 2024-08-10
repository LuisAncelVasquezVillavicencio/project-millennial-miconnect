<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sent extends Model
{
    //tb_sent
    
    protected $table = 'tb_sent';
    protected $guarded =  [];
    protected $primaryKey = 'ID_ENVIO';
    
    
    
    public function GetSentStatus($id_grupo,$etiqueta){
        
        $sent = DB::table('tb_sent')
                     ->leftJoin('tb_contactos', 'tb_sent.ID_CONTACTO', '=', 'tb_contactos.ID_CONTACTO')
                     ->join('tb_sent_status', 'tb_sent.ID_ENVIO', '=', 'tb_sent_status.ID_ENVIO')
                     ->select(DB::raw('max(tb_sent_status.updated_at) as max_date_actualizacion ,
                                       tb_contactos.ID_CONTACTO,
                                       tb_contactos.NOMBRE,
                                       tb_contactos.APELLIDO,
                                       tb_contactos.NUMERO, 
                                       tb_sent_status.SENT,
                                       tb_sent_status.DELIVERED,
                                       tb_sent_status.VIEWED
                                      '))
                     ->where([['tb_contactos.ID_GRUPO','=', $id_grupo],
							  ['tb_sent.ETIQUETA','=',$etiqueta]
							 ])
                     ->groupByRaw('tb_contactos.ID_CONTACTO,
                                   tb_contactos.NOMBRE,
                                   tb_contactos.APELLIDO,
                                   tb_contactos.NUMERO
                                  ')
                     ->paginate(300);
        
        return $sent ;
    }
    
    
    public function GetSentStatusExport($id_grupo,$etiqueta){
        
        $sent = DB::table('tb_sent')
                     ->leftJoin('tb_contactos', 'tb_sent.ID_CONTACTO', '=', 'tb_contactos.ID_CONTACTO')
                     ->join('tb_sent_status', 'tb_sent.ID_ENVIO', '=', 'tb_sent_status.ID_ENVIO')
                     ->select(DB::raw('max(tb_sent_status.updated_at) as max_date_actualizacion ,
                                       tb_contactos.ID_CONTACTO,
                                       tb_contactos.NOMBRE,
                                       tb_contactos.APELLIDO,
                                       tb_contactos.NUMERO, 
                                       tb_sent_status.SENT,
                                       tb_sent_status.DELIVERED,
                                       tb_sent_status.VIEWED
                                      '))
                     ->where([['tb_contactos.ID_GRUPO','=', $id_grupo],
							  ['tb_sent.ETIQUETA','=',$etiqueta]
							 ])
                     ->groupByRaw('tb_contactos.ID_CONTACTO,
                                   tb_contactos.NOMBRE,
                                   tb_contactos.APELLIDO,
                                   tb_contactos.NUMERO
                                  ')
                     ->get();
                     
                     
  
        
        return $sent ;
    }
    
    
    
    
}
