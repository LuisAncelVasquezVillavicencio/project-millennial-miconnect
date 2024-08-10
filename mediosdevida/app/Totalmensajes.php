<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Totalmensajes extends Model
{
     protected $table = 'temp_totalmessages';
     protected $guarded =  [];
     protected $primaryKey = 'TOKEN';
}
