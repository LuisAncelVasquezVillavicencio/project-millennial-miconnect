<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Grupo;
use App\Contacto;
use App\WhatsAppBot;
use App\Sent;
use App\Sent_status;
use App\Sent_error;
use App\Jobs\ProcessWassapSent;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index()
    {
        
        $alerta = array();
        $alerta['notice']  = null;
        $alerta['warning'] = null;
        $alerta['error']   = null ;
     
        
        $id_usuario = Auth::user()->id;
        $grupo = Grupo::latest()->get();

        return view('Home.home', compact('grupo','alerta'));
     
        
    }
    
   
    
    
    
    
}
