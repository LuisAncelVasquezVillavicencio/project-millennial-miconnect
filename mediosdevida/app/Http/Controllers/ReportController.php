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
use Response;
use View;

class ReportController extends Controller
{
    
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
     public function index()
    {
        
        $alerta = array();
        $alerta['notice']  = null;
        $alerta['warning'] = null;
        $alerta['error']   = null ;
     
        
        $id_usuario = Auth::user()->id;
        $grupo = Grupo::latest()->get();

        return view('report.report', compact('grupo','alerta'));
     
        
    }
    
    public function report_1(Request $request)
    {
        
        
        $id_grupo = request('id_grupo');
        $grupo = Grupo::latest()->where('ID_GRUPO', $id_grupo)->get();
        $contactos = Contacto::latest()->where('ID_GRUPO', $id_grupo)->get();
        
        $sent = DB::table('tb_sent')
                     ->leftJoin('tb_contactos', 'tb_sent.ID_CONTACTO', '=', 'tb_contactos.ID_CONTACTO')
                     ->where('tb_contactos.ID_GRUPO', $id_grupo)
                     ->select(DB::raw('count(distinct(tb_sent.ID_CONTACTO)) as count_contactos ,
                                       min(date(tb_sent.created_at)) as date_create ,
                                       max(date(tb_sent.created_at)) as date_update ,
                                       tb_sent.ETIQUETA as etiqueta '))
                     ->groupByRaw('tb_sent.ETIQUETA' )
                     ->get();
        
        return view('report.report1', compact('grupo' , 'sent'));
        
    }
    
    public function report_2(Request $request)
    {
        $id_grupo = request('id_grupo');
        $etiqueta = request('etiqueta');
        
        $grupo = Grupo::latest()->where('ID_GRUPO', $id_grupo)->get();
        $contactos = Contacto::latest()->where('ID_GRUPO', $id_grupo)->get();

        $sended = Sent::select('tb_sent.ID_CONTACTO')->distinct()->leftJoin('tb_contactos', 'tb_sent.ID_CONTACTO', '=', 'tb_contactos.ID_CONTACTO')
        ->where([['tb_contactos.ID_GRUPO','=', $id_grupo],
        ['tb_sent.ETIQUETA','=',$etiqueta]
       ])->get()->toArray();

        $notSended = Sent_error::leftJoin('tb_contactos', 'tb_sent_error.ID_CONTACTO', '=', 'tb_contactos.ID_CONTACTO')
            ->select('tb_contactos.ID_CONTACTO')->distinct()
            ->where('tb_sent_error.ETIQUETA',$etiqueta)
            ->where('tb_contactos.ID_GRUPO',$id_grupo)
            ->get()->toArray();
        $total_enviado = array_unique(array_merge($sended,$notSended), SORT_REGULAR);
        $total_enviado = count($total_enviado);

        
        $contacto = Sent::leftJoin('tb_contactos', 'tb_sent.ID_CONTACTO', '=', 'tb_contactos.ID_CONTACTO')
        ->where([['tb_contactos.ID_GRUPO','=', $id_grupo],
                ['tb_sent.ETIQUETA','=',$etiqueta]
                ])
        ->first();

        $contacto = $contacto->ID_CONTACTO;

        $msm = DB::table('tb_sent')
                    //  ->leftJoin('tb_contactos', 'tb_sent.ID_CONTACTO', '=', 'tb_contactos.ID_CONTACTO')
                    //  ->join('tb_sent_status', 'tb_sent.ID_ENVIO', '=', 'tb_sent_status.ID_ENVIO')
                     ->select('tb_sent.BODY','tb_sent.KEY')->distinct()
                     ->where([['tb_sent.ID_CONTACTO','=', $contacto],
							  ['tb_sent.ETIQUETA','=',$etiqueta]
							 ])
                     ->get();
        
        $count_msm = DB::table('tb_sent')
                     ->leftJoin('tb_contactos', 'tb_sent.ID_CONTACTO', '=', 'tb_contactos.ID_CONTACTO')
                     ->where([['tb_contactos.ID_GRUPO','=', $id_grupo],
							  ['tb_sent.ETIQUETA','=',$etiqueta]
							 ])
                     ->count();
             
        $sent = ((new Sent)->GetSentStatus($id_grupo,$etiqueta));
                     
        $sent_error = DB::table('tb_sent_error')
                     ->leftJoin('tb_contactos', 'tb_sent_error.ID_CONTACTO', '=', 'tb_contactos.ID_CONTACTO')
                     ->select(DB::raw('tb_sent_error.*,tb_contactos.*'))
                     ->where('tb_sent_error.ETIQUETA',$etiqueta)
                     ->paginate(7);
      
        return view('report.report2', compact('grupo' , 'sent','msm','etiqueta','sent_error','count_msm','total_enviado'));
    }
    
    
    
    public function ajax_GetSentStatus(Request $request)
    {
        $id_grupo = request('id_grupo');
        $etiqueta = request('etiqueta');
        
        $sent = ((new Sent)->GetSentStatus($id_grupo,$etiqueta));
        
        if ($request->ajax()) {
            return Response::json(View::make('report.GetSentStatus', array('sent' => $sent))->render());
        }

        return View::make('report.GetSentStatus', array('sent' => $sent));
    }
    
    
    
    
    
}
