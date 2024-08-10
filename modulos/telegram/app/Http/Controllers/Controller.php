<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
//use OpenApi\Annotations as OA;

/**
     * @OA\Info(
     *      version="1.0.0",
     *      x={
     *          "logo": {
     *              "url": "https://via.placeholder.com/190x90.png?text=L5-Swagger"
     *          }
     *      },
     *      title="Whatsapp OpenApi",
     *      description="Whatsapp OpenApi descripción",
     *      @OA\Contact(
     *          email="lvasquez@millev.com"
     *      ),
     *     @OA\License(
     *         name="Apache 2.0",
     *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
     *     )
     * )
*/
     
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    
}
