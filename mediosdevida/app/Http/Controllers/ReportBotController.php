<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class ReportBotController extends Controller
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
    public function IndexReporte1()
    {
        
        $alerta = array();
        $alerta['notice']  = null;
        $alerta['warning'] = null;
        $alerta['error']   = null ;
        
        $id=4;
        //Encuesta de satisfacción 2
         $nombre="Encuesta de satisfacción";
        $resul_opciones = DB::table('tb_bot_resultados_encuesta_opciones')->where('ID_ENCUESTA',1)->orderBy('NUMERO', 'DESC')->orderBy('created_at', 'DESC')->paginate(15);
        $resul_final = DB::table('tb_bot_resultados_encuesta_final')->where('ID_ENCUESTA',1)->paginate(15);
        
        return view('ReportBot.Reporte1', compact('resul_opciones','resul_final','nombre','id'));
    }
    
    public function IndexReporte2()
    {
        
        $alerta = array();
        $alerta['notice']  = null;
        $alerta['warning'] = null;
        $alerta['error']   = null ;
        
        $id=3;
        $nombre="Salud Mental - Auto cuidado";
        $resul_opciones = DB::table('tb_bot_resultados_encuesta_opciones')->where('ID_ENCUESTA',3)->orderBy('NUMERO', 'DESC')->orderBy('created_at', 'DESC')->paginate(15);
        $resul_final = DB::table('tb_bot_resultados_encuesta_final')->where('ID_ENCUESTA',3)->paginate(15);
        
        return view('ReportBot.Reporte1', compact('resul_opciones','resul_final','nombre','id'));
     
        
    }
    
    public function IndexReporte3()
    {
        
        $alerta = array();
        $alerta['notice']  = null;
        $alerta['warning'] = null;
        $alerta['error']   = null ;
        
        $id=5;
        //Encuesta de satisfacción 2
        $nombre="Tu media Naranja";
        $resul_opciones = DB::table('tb_bot_resultados_encuesta_opciones')->where('ID_ENCUESTA',5)->orderBy('NUMERO', 'DESC')->orderBy('created_at', 'DESC')->paginate(15);
        $resul_final = DB::table('tb_bot_resultados_encuesta_final')->where('ID_ENCUESTA',5)->paginate(15);
        
        return view('ReportBot.Reporte1', compact('resul_opciones','resul_final','nombre','id'));
     
        
    }
    
    
    
    
}
