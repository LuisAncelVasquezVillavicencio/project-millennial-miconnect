<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recive extends Model
{
    //
    protected $table = 'tb_recive';
    protected $guarded =  [];
    protected $primaryKey = 'ID_RECIVE';
    
    /*
    *
    * Luis Ancel Vasquez
    * Relacion con contacto eloquent
    */
    public function contacto(){
        return $this->hasOne(Contacto::class, 'ID_CONTACTO', 'ID_CONTACTO');
    }

    
    
    
    public function GetRecibeList(){
        $recibe = $list_recive = Recive::latest()->get(); 
        return $recibe ;
    }
    
    
    
}
