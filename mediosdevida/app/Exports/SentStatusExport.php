<?php

namespace App\Exports;

use App\Sent_status;
use App\Sent;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class SentStatusExport implements FromView
{
    use Exportable;
    
    private $etiqueta;
    private $id_grupo; 
    
    public function __construct($id_grupo,$etiqueta){
        $this->etiqueta = $etiqueta;
        $this->id_grupo = $id_grupo;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
       /* return view('exports.SentStatusExport',[
           'sent' => 
        ]);*/
        $sent = (new Sent)->GetSentStatusExport($this->id_grupo,$this->etiqueta);
        return view('exports.SentStatusExport', compact('sent'));
    }
    
    
}
