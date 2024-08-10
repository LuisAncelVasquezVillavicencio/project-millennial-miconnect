<?php

namespace App;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;




 
class WhatsappDeleted extends Model
{
    
   protected $table = 'whatsappDeletedMessages';
   protected $primaryKey = 'id';
   protected $guarded =  [];
   /**
     * Class Whatsapp.
     *
     * @author  Luis Ancel Vasquez <lvasquez@millev.com>
     *
     * @OA\Schema(
     *     description="Whatsapp modelo",
     *     title="Whatsapp modelo",
     *     required={"name", "photoUrls"},
     *     @OA\Xml(
     *         name="Pet"
     *     )
     * )
   */
    
    
    
    
}

