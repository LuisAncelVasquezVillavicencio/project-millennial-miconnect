<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sent_error extends Model
{
    //tb_sent_error
    
     protected $table = 'tb_sent_error';
     protected $guarded =  [];
     protected $primaryKey = 'ID_SENT_ERROR';
}
