<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'tb_pais';
    public $timestamps = true;
    protected $primaryKey = 'ID_PAIS';
}
