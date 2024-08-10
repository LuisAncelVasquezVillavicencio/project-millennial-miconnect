<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recive;
use App\Grupo;
use App\Contacto;
use App\WhatsAppBot;
use App\Sent;
use App\Sent_status;
use Auth;

class ReciveController extends Controller
{
  
  
      public function __construct()
      {
          $this->middleware('auth');
      }
    
  
      public function index(Request $request)
      {
        
        $alerta = array();
        $alerta['notice']  = null;
        $alerta['warning'] = null;
        $alerta['error']   = null ;
        $id_usuario = Auth::user()->id;
    
        $cant_recibidos = Recive::count(); 
        $list_recive = Recive::latest()->paginate(20); 
        
        
        return view('recive.recive_list', compact('cant_recibidos','list_recive','alerta'));
        
      }
      
}
