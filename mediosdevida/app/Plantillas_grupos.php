<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plantillas_grupos extends Model
{
    //
    protected $table = 'tb_grupo_plantilla';
    public $timestamps = true;
    protected $primaryKey = 'ID_PLANTILLA';
}
