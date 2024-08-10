<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Config_wassap;

class ConfigwassapController extends Controller
{
    //
    public function index(Request $request)
    {
      
      $instancias = Config_wassap::get();
      
       if($request->ajax()){
         return view("Config.inst_mods.instancias_table",compact('instancias'))->render(); 
       }
    
      return view("Config.instancias",compact('instancias'));
       
    }
}
