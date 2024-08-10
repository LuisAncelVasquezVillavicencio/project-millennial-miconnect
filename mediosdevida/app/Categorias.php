<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Grupo;

class Categorias extends Model
{
    //
    
    protected $table = 'tb_categorias';
    protected $guarded =  [];
    protected $primaryKey = 'ID_CATEGORIA';
    
    public function grupos(){
         return $this->hasMany(Grupo::class,'ID_CATEGORIA','ID_CATEGORIA');
    }
}
