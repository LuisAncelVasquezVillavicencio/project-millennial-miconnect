<?php

namespace App\Exports;

use App\Contacto;
use App\Grupo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ContactosExport implements FromView
{
    use Exportable;
   
    private $id_grupo; 
    
    public function __construct($id_grupo,$Tipo){
        $this->id_grupo = $id_grupo;
        $this->Tipo = $Tipo;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        if($this->Tipo != "modelo"){
         $contactos = Contacto::where("ID_GRUPO","=",$this->id_grupo)->join('tb_pais','tb_pais.ID_PAIS','=','tb_contactos.ID_PAIS')->get();   
        }
        else{
         $contactos = null;
        }
        
        $grupo_data = Grupo::where("ID_GRUPO","=",$this->id_grupo)->get()->first();

        return view('exports.ContactosExport', compact('contactos','grupo_data'));
    }
    
    
}