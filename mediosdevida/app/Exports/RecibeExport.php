<?php

namespace App\Exports;

use App\Sent_status;
use App\Sent;
use App\Recive;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class RecibeExport implements FromView
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
        $recive = (new Recive)->GetRecibeList();
        return view('exports.ReciveExport', compact('recive'));
    }
    
    
}
