<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use App\Empresa;
use Illuminate\Support\Facades\Http;
use OpenApi\Annotations as OA;
use Log;

/**
* @OA\SecurityScheme(
*      securityScheme="bearerAuth",
*      in="header",
*      name="bearerAuth",
*      type="http",
*      scheme="bearer",
*      bearerFormat="JWT",
* ),
* */

class WebhookController extends Controller
{
    

     
     
    function webhook(Request $request){
        
        
        
       $x = $request->all();
       $b = json_encode($x);
       Log::info($b);
       // {"hub_mode":"subscribe","hub_challenge":"1915750500","hub_verify_token":"EAAPmKaDlIbEBAIN5or2SInnO5EnqFfyrB02OJ0wG9jY4IWnswnWmaCInZCKgnSYR9XqFXD7lRWRHZCpbN9wAtslyFAooXZC8x6Hfzjvmoo0dC6ZBaQVinK1gpVCtFfMN55a5cPT2uOOHOapTyyrP9ZA5LZBFT7OkQXh85gZCyCtzIZBOLl5wZBpJpFQRWPZAoXq47lX9ZAolhVBbVU0Vw3h21MM"}
       
       
       
       //siempre retornar para
       return $request->hub_challenge;
    }
    
    
    
    
}
