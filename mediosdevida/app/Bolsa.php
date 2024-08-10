<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bolsa extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey = "cod_mes";
    protected $table = "tb_bolsa";
    
    
}
