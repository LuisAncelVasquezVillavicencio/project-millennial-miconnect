<?php

namespace App\Exports;

use App\Sent_status;
use App\Sent;
use App\Recive;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class BotExport1 implements FromView
{
    use Exportable;
    
    public function __construct(){
        
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
       /* return view('exports.SentStatusExport',[
           'sent' => 
        ]);*/
        $resul_opciones = DB::table('tb_bot_resultados_encuesta_opciones')->where('ID_ENCUESTA',4)->orderBy('NUMERO', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('exports.BotExport1', compact('resul_opciones'));
    }
    
    
}
