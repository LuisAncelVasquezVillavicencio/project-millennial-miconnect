<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Botpreguntas;

class Bot extends Model
{
    //
   protected $table = 'tb_bot_encuestas';
   protected $guarded =  [];
   protected $primaryKey = 'ID_ENCUESTA';
   public $timestamps = false;
   
   public function pregunta(){
         return $this->hasMany(Botpreguntas::class,'ID_ENCUESTA','ID_ENCUESTA');
    }
}
