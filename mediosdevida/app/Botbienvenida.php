<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Botbienvenida extends Model
{
    //
   protected $table = 'tb_bot_bienvenida';
   protected $guarded =  [];
   public $timestamps = false;
   protected $primaryKey = 'ID_BIENVENIDA';
}
