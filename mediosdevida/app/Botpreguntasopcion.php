<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Botpreguntasopcion extends Model
{
    //
   protected $table = 'tb_bot_preguntas_opciones';
   protected $guarded =  [];
   public $timestamps = false;
   protected $primaryKey = 'ID_OPCIONES';
   
}
