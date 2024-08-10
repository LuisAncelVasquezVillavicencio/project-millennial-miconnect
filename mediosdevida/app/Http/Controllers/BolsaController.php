<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Config_wassap;
use App\Sent;
use App\Bolsa;
use Carbon\Carbon;

class BolsaController extends Controller
{
    //
    
    public function index(){
       
       $now  = Carbon::now();
       $month = Carbon::now()->month;
       $year = Carbon::now()->year;
       $bolsa = Bolsa::find($year.$month);
       $cantidad_mensajes_por_mes = $bolsa->max_mensajes;
       $mensajes_enviados = Sent::whereYear('created_at', '=', $year)
       ->whereMonth('created_at', '=', $month)->count();
      
       $porcentaje = (100 * $mensajes_enviados)/$cantidad_mensajes_por_mes;
       $porcentaje = round($porcentaje,2);
       
       return view("Bolsa.bolsa_actual",compact("cantidad_mensajes_por_mes","mensajes_enviados","porcentaje"));
       
    }
}
