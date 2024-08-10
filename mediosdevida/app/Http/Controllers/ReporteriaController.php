<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Botfinal;
use Botresultados;
use Botactivos;
use DB;
use Excel;
use App\Exports\ReporteriaExport1;
use App\Exports\ReporteriaExport2;
use App\Exports\ReporteriaExport3;
class ReporteriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    
    public function index($id){

    	$count_total_cerrado = DB::table('tb_bot_resultados_encuesta_final')
                     ->where('tb_bot_resultados_encuesta_final.ID_ENCUESTA',$id)
                     ->count();

        $count_total_abierto = DB::table('tb_bot_temp_job_encuesta_usuario')
                     ->where('tb_bot_temp_job_encuesta_usuario.ID_ENCUESTA',$id)
                     ->where('tb_bot_temp_job_encuesta_usuario.STATUS_ULTIMA_RESPUESTA','=','0')
                     ->count();

        $listado_resultados = DB::table('tb_bot_resultados_encuesta_opciones')
        						->where('tb_bot_resultados_encuesta_opciones.ID_ENCUESTA',$id)
        						->latest()
        						->paginate(20);

    	return view('reporteria.index',compact('count_total_cerrado','count_total_abierto','listado_resultados','id'));
    }

    public function reporteria_01($id){
        
        $reporteria1 = DB::table('tb_bot_resultados_encuesta_opciones')
        						->where('tb_bot_resultados_encuesta_opciones.ID_ENCUESTA',$id)
        						->latest()
        						->get();

        return Excel::download(new ReporteriaExport1($reporteria1), 'Reporteria_01.xlsx');
    }
    
    public function reporteria_02($id){
        
        $reporteria2 = DB::table('tb_bot_resultados_encuesta_final')
                                ->join('tb_bot_encuestas','tb_bot_resultados_encuesta_final.ID_ENCUESTA','=','tb_bot_encuestas.ID_ENCUESTA')
        						->where('tb_bot_resultados_encuesta_final.ID_ENCUESTA',$id)
        						->get();

        return Excel::download(new ReporteriaExport2($reporteria2), 'Reporteria_02.xlsx');
    }
    
    public function reporteria_03($id){
        
        $reporteria3 = DB::table('tb_bot_temp_job_encuesta_usuario')
                                ->join('tb_bot_encuestas','tb_bot_temp_job_encuesta_usuario.ID_ENCUESTA','=','tb_bot_encuestas.ID_ENCUESTA')
                                ->join('tb_bot_preguntas','tb_bot_temp_job_encuesta_usuario.STATUS_ULTIMA_PREGUNTA','=','tb_bot_preguntas.ID_PREGUNTA')
        						->where('tb_bot_temp_job_encuesta_usuario.ID_ENCUESTA',$id)
        						->where('tb_bot_preguntas.ID_ENCUESTA',$id)
        						->where('tb_bot_temp_job_encuesta_usuario.STATUS_ULTIMA_RESPUESTA','=','0')
        						->get();

        return Excel::download(new ReporteriaExport3($reporteria3), 'Reporteria_03.xlsx');
    }
}
