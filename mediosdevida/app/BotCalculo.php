<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BotCalculo extends Model
{
    //
   protected $table = 'tb_bot_encuestas_calculos';
   protected $guarded =  [];
   public $timestamps = false;
   protected $primaryKey = 'ID_RESULTADO';
}
