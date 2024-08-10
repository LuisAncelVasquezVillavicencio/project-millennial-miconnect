<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bot;
use App\Botpreguntasopcion;

class Botpreguntas extends Model
{
    //
    
   protected $table = 'tb_bot_preguntas';
   protected $guarded =  [];
   public $timestamps = false;
   
   public function encuesta()
    {
        return $this->belongsTo(Bot::class, 'ID_ENCUESTA', 'ID_ENCUESTA');
    }
    
   public function respuestas()
    {
        return $this->hasMany(Botpreguntasopcion::class, 'ID_ENCUESTA', 'ID_ENCUESTA')->where("ID_PREGUNTA",$this->ID_PREGUNTA);
    }
}
