<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlantillaController extends Controller
{
    //
    public function show(Request $request){
        
        if ($request->ajax()) {
            
            $contactos = Contacto::where("ID_GRUPO",'=',$request->grupo)->orderBy('updated_at', 'desc')->paginate(9);
            return view('Contacto.contactos_grupo',['contactos_grupo'=>$contactos,'grupos'=>$grupos,'pais'=>$pais])->render();  
 
        }
        return view("Plantillas.plantillas");
    }
}
