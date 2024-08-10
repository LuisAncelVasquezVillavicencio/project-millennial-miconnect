<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
   protected $table = 'empresa';
   protected $primaryKey = 'empresa_id';
   protected $guarded =  [];
   //public $timestamps = false;
}
