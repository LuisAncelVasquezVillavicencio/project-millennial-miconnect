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
use App\Config_wassap;
use Auth;
use App\Bolsa;
use Carbon\Carbon;

class SentController extends Controller
{
    
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    
      public function sent1(Request $request)
      {
        
        $alerta = array();
        $alerta['notice']  = null;
        $alerta['warning'] = null;
        $alerta['error']   = null ;
     
        
        $id_usuario = Auth::user()->id;
        $grupos = Grupo::withCount("contactos")->get();
        return view('sent.envio_masivo.paso1', compact('grupos','alerta'));
      }
      
    /*
    Edit: 15/07/2020
    Jesus Salgadp
    Se agrega Trim para filtros
    */  
    public function sent2(Request $request)
    {
        $alerta = array();
        $alerta['notice']  = null;
        $alerta['warning'] = null;
        $alerta['error']   = null ;
        
        $id_usuario = Auth::user()->id;
        $id_grupo = request('id_grupo');
        $grupo = Grupo::latest()->where('ID_GRUPO', $id_grupo)->get();
        if (!$request->ajax()) {
           
           $list_contactos = Contacto::where('ID_GRUPO', $id_grupo )->orderBy("created_at","desc")->get();
           
           $list_contactos_paginada = Contacto::where('ID_GRUPO', $id_grupo )->orderBy("created_at","desc")->paginate(100);
           
           //* VALIDAD SI EXISTEN CONTACTOS */
           if($list_contactos->count()==0){
               $alerta['warning'] = "No existen contactos asignados a este grupo";
               return redirect()->route('Sent_1');
           }
           
           
           session(['list_contacto' => $list_contactos]);
           session(['item_grupo' => $grupo]);
        }
        
        /* GENERAR FILTROS */
        $filtro_1 = array_column( Contacto::selectRaw('TRIM(VAL_GRUPO1) as VAL_GRUPO1')->where('ID_GRUPO', $id_grupo )->distinct()->get()->toArray(), 'VAL_GRUPO1');
        $filtro_2 = array_column( Contacto::selectRaw('TRIM(VAL_GRUPO2) as VAL_GRUPO2')->where('ID_GRUPO', $id_grupo )->distinct()->get()->toArray(), 'VAL_GRUPO2');
        $filtro_3 = array_column( Contacto::selectRaw('TRIM(VAL_GRUPO3) as VAL_GRUPO3')->where('ID_GRUPO', $id_grupo )->distinct()->get()->toArray(), 'VAL_GRUPO3');
        $filtro_4 = array_column( Contacto::selectRaw('TRIM(VAL_GRUPO4) as VAL_GRUPO4')->where('ID_GRUPO', $id_grupo )->distinct()->get()->toArray(), 'VAL_GRUPO4');
        $filtro_5 = array_column( Contacto::selectRaw('TRIM(VAL_GRUPO5) as VAL_GRUPO5')->where('ID_GRUPO', $id_grupo )->distinct()->get()->toArray(), 'VAL_GRUPO5');
         
        $data_filtros = [  mb_strtoupper("GRUPO1") => ["cabecera"=> $grupo[0]->NOM_GRUPO_1,"filtros" =>$filtro_1] , 
                           mb_strtoupper("GRUPO2") => ["cabecera"=> $grupo[0]->NOM_GRUPO_2,"filtros" =>$filtro_2] , 
                           mb_strtoupper("GRUPO3") => ["cabecera"=> $grupo[0]->NOM_GRUPO_3,"filtros" =>$filtro_3] , 
                           mb_strtoupper("GRUPO4") => ["cabecera"=> $grupo[0]->NOM_GRUPO_4,"filtros" =>$filtro_4], 
                           mb_strtoupper("GRUPO5") => ["cabecera"=> $grupo[0]->NOM_GRUPO_5,"filtros" =>$filtro_5] , 
                      ];

        /*VALIDAR SI EXISTEN FILTROS*/              
        $disable_filtros=false;
        $cantidad_filtros=count(array_filter($data_filtros));
        if($cantidad_filtros==0){
             $disable_filtros=true;
             $alerta['warning'] = "No existen filtros disponibles para este grupo";
        }else{
             $disable_filtros=false;
        }
        
        /* METODP AJAX PARA LA PREVISUALIZACION DE CONTACTOS*/
        if ($request->ajax()) {
            
            //Re_fact en una sola cadena
            
            
            $array_1 = (null !== ($request->get("VAL_GRUPO1"))) ? "(VAL_GRUPO1 in ('".((count($request->get("VAL_GRUPO1")) > 0) ? implode("','",$request->get("VAL_GRUPO1")) : "VAL_GRUPO1")."') or (VAL_GRUPO1 is null or VAL_GRUPO1 = ''))" : " (VAL_GRUPO1 = VAL_GRUPO1 or VAL_GRUPO1 is null)" ;
            $array_2 = (null !== ($request->get("VAL_GRUPO2"))) ? " and (VAL_GRUPO2 in ('".((count($request->get("VAL_GRUPO2")) > 0) ? implode("','",$request->get("VAL_GRUPO2")) : "VAL_GRUPO2")."') or VAL_GRUPO2 is null)" : " and (VAL_GRUPO2 = VAL_GRUPO2 or VAL_GRUPO2 is null)" ;
            $array_3 = (null !== ($request->get("VAL_GRUPO3"))) ? " and (VAL_GRUPO3 in ('".((count($request->get("VAL_GRUPO3")) > 0) ? implode("','",$request->get("VAL_GRUPO3")) : "VAL_GRUPO3")."') or VAL_GRUPO3 is null)" : " and (VAL_GRUPO3 = VAL_GRUPO3 or VAL_GRUPO3 is null)" ;
            $array_4 = (null !== ($request->get("VAL_GRUPO4"))) ? " and (VAL_GRUPO4 in ('".((count($request->get("VAL_GRUPO4")) > 0) ? implode("','",$request->get("VAL_GRUPO4")) : "VAL_GRUPO4")."') or VAL_GRUPO4 is null)" : " and (VAL_GRUPO4 = VAL_GRUPO4 or VAL_GRUPO4 is null)" ;
            $array_5 = (null !== ($request->get("VAL_GRUPO5"))) ? " and (VAL_GRUPO5 in ('".((count($request->get("VAL_GRUPO5")) > 0) ? implode("','",$request->get("VAL_GRUPO5")) : "VAL_GRUPO5")."') or VAL_GRUPO5 is null)" : " and (VAL_GRUPO5 = VAL_GRUPO5 or VAL_GRUPO5 is null)" ;
            
            
            $list_contactos = Contacto::where("ID_GRUPO",$id_grupo)->whereRaw($array_1.$array_2.$array_3.$array_4.$array_5)->get();
            $list_contactos_paginada = Contacto::where("ID_GRUPO",$id_grupo)->whereRaw($array_1.$array_2.$array_3.$array_4.$array_5)->paginate(100);
            $list_contactos_count = count($list_contactos);
            session(['list_contacto' => $list_contactos]);
            return view('sent.envio_masivo.paso2-table', compact('disable_filtros','data_filtros','list_contactos','id_grupo','list_contactos_paginada','list_contactos_count'));
         }
         
        $list_contactos_count = count($list_contactos);
        return view('sent.envio_masivo.paso2', compact('disable_filtros','cantidad_filtros','data_filtros','list_contactos','id_grupo','alerta','grupo','list_contactos_paginada','list_contactos_count'));
        
    }
      
      
  
      
      
      public function sent3(Request $request)
      {
        
        $list_contactos = session('list_contacto');
        $item_grupo = session('item_grupo');
        
        $marcadores = 
            ["Grupo" => "Nombre de grupo", 
            "VAL_GRUPO1" => $item_grupo[0]->NOM_GRUPO_1, 
            "VAL_GRUPO2" => $item_grupo[0]->NOM_GRUPO_2, 
            "VAL_GRUPO3" => $item_grupo[0]->NOM_GRUPO_3, 
            "VAL_GRUPO4" => $item_grupo[0]->NOM_GRUPO_4, 
            "VAL_GRUPO5" => $item_grupo[0]->NOM_GRUPO_5,
            "NOMBRE"=>"Nombres",
            "APELLIDO"=>"Apellidos",
            "NUMERO"=>"Numero"];
         // $marcadores = json_encode($marcadores);
         
          $now  = Carbon::now();
          $month = Carbon::now()->month;
          $year = Carbon::now()->year;
          $bolsa = Bolsa::find($year.$month);
          $cantidad_mensajes_por_mes = $bolsa->max_mensajes;
          $mensajes_enviados = Sent::whereYear('created_at', '=', $year)
          ->whereMonth('created_at', '=', $month)->count();
         
          $porcentaje = (100 * $mensajes_enviados)/$cantidad_mensajes_por_mes;
          $porcentaje = round($porcentaje,2);
         
        $instancia = Config_wassap::select("ID_WASSAP",'ESTADO','PROPIETARIO')->where("MOSTRAR","SI")->where('ESTADO','authenticated')->get();
        // return view('sent.sent3', compact('list_contactos','item_grupo','instancia','marcadores',"cantidad_mensajes_por_mes","mensajes_enviados","porcentaje"));
        return view('sent.envio_masivo.paso3', compact('list_contactos','item_grupo','instancia','marcadores',"cantidad_mensajes_por_mes","mensajes_enviados","porcentaje"));

      }
      
      //Actualizar lista de instancias
      public function sent3_instancia(Request $request){
         $instancia = Config_wassap::select("ID_WASSAP",'ESTADO','PROPIETARIO')->where("MOSTRAR","SI")->where('ESTADO','authenticated')->get();
         
         $data = [
            "instancias" => $instancia
            ];
        
        return $data ;
         
      }
      
      
      public function sent4(Request $request)
      {
        
        $all = $request->all();
        $etiqueta = request('txt_etiqueta');
        $key = request('txt_key');
        
        $list_contactos = session('list_contacto');
        $grupo = session('item_grupo');
        $id_grupo = $grupo[0]->ID_GRUPO;
        
        $list_resultados= array() ;
        $list_resultados_ERROR = array() ;
        
        $grupo_in = Grupo::find($id_grupo);
        
        $valor_1 = (trim($grupo_in->NOM_GRUPO_1) != "" ) ? ":".$grupo_in->NOM_GRUPO_1.":" : null;
        $valor_2 = (trim($grupo_in->NOM_GRUPO_2) != "" ) ? ":".$grupo_in->NOM_GRUPO_2.":" : null;
        $valor_3 = (trim($grupo_in->NOM_GRUPO_3) != "" ) ? ":".$grupo_in->NOM_GRUPO_3.":" : null;
        $valor_4 = (trim($grupo_in->NOM_GRUPO_4) != "" ) ? ":".$grupo_in->NOM_GRUPO_4.":" : null;
        $valor_5 = (trim($grupo_in->NOM_GRUPO_5) != "" ) ? ":".$grupo_in->NOM_GRUPO_5.":" : null;
        
        $Titulo = ":Nombre de grupo:";
        $Nombre_s = ":Nombres:";
        $Apellido_s = ":Apellidos:";
        $Numero_s = ":Numero:";
        // $instancia = Config_wassap::find($request->instancia_envio);
        $instancia = Config_wassap::where("ID_WASSAP",$request->get("instancia"))->first();
      //  return dd($instancia);
      
      

        foreach ($all as $clave => $valor) {
            if(!($clave=='_token' or $clave=='txt_etiqueta' or $clave=='txt_key')){
               
                  
               
                 $i = substr($clave, 0, 8);
                 $WhatsAppBot = new WhatsAppBot();
                 foreach ($list_contactos as $item) {
                
                  //  $APIurl =  'https://eu190.chat-api.com/instance188331/';
                  //  $token  =  'ci8unwg89sd0q5nd';
                   $APIurl = $instancia->URL;
                   $token = $instancia->API_KEY;
                   
                   $mensaje = $valor ;
                   $id_contacto = $item->ID_CONTACTO;
                   $nombre = $item->NOMBRE;
                   $apellido = $item->APELLIDO;
                   $apellido_nombre = $nombre.' '.$apellido;
                   
                   $numero = $item->NUMERO;
                   $cod_pais = $item->pais->COD_TEL_PAIS;
                   $nom_pais = $item->pais->NOMBRE_PAIS;
                   
                   //Reemplazando etiquetas y menciones
                   if($valor_1 != null) {
                      $mensaje = str_replace($valor_1,$item->VAL_GRUPO1,$mensaje);
                   }
                   if($valor_2 != null) {
                      $mensaje = str_replace($valor_2,$item->VAL_GRUPO2,$mensaje);
                   }
                   if($valor_3 != null) {
                      $mensaje = str_replace($valor_3,$item->VAL_GRUPO3,$mensaje);
                   }
                   if($valor_4 != null) {
                      $mensaje = str_replace($valor_4,$item->VAL_GRUPO4,$mensaje);
                   }
                   if($valor_5 != null) {
                      $mensaje = str_replace($valor_5,$item->VAL_GRUPO5,$mensaje);
                   }
                   
                   $mensaje = str_replace($Titulo,$grupo_in->TITULO,$mensaje);
                   $mensaje = str_replace($Nombre_s,$item->NOMBRE,$mensaje);
                   $mensaje = str_replace($Apellido_s,$item->APELLIDO,$mensaje);
                   $mensaje = str_replace($Numero_s,$item->NUMERO,$mensaje);
                   $mensaje = str_replace("&nbsp;"," ",$mensaje);
                  //  dd($mensaje);
                   
                   $type_msm="";
                   ProcessWassapSent::dispatch($i,$cod_pais, $numero ,$mensaje,$APIurl,$token,$id_contacto,$etiqueta,$key);
                   
                   
      //              $msm = DB::table('tb_sent')
      //                ->leftJoin('tb_contactos', 'tb_sent.ID_CONTACTO', '=', 'tb_contactos.ID_CONTACTO')
      //                ->join('tb_sent_status', 'tb_sent.ID_ENVIO', '=', 'tb_sent_status.ID_ENVIO')
      //                ->select('tb_sent.BODY')->distinct()
      //                ->where([['tb_contactos.ID_GRUPO','=', $id_grupo],
						// 	  ['tb_sent.ETIQUETA','=',$etiqueta]
						// 	 ])
      //                ->get();
        
      //             $count_msm = DB::table('tb_sent')
      //                            ->leftJoin('tb_contactos', 'tb_sent.ID_CONTACTO', '=', 'tb_contactos.ID_CONTACTO')
      //                            ->where([['tb_contactos.ID_GRUPO','=', $id_grupo],
      //       							  ['tb_sent.ETIQUETA','=',$etiqueta]
      //       							 ])
      //                            ->count();
                                 
      //              $sent = ((new Sent)->GetSentStatus($id_grupo,$etiqueta));
                                 
      //              $sent_error = DB::table('tb_sent_error')
      //                            ->leftJoin('tb_contactos', 'tb_sent_error.ID_CONTACTO', '=', 'tb_contactos.ID_CONTACTO')
      //                            ->select(DB::raw('tb_sent_error.*,tb_contactos.*'))
      //                            ->where('tb_sent_error.ETIQUETA',$etiqueta)
      //                            ->get();
                     
                   
               }
             
            }
        }

        // return view('sent.sent_animate', compact('grupo' , 'etiqueta'));
        
        return redirect()->route("Sent_1")->with(["success"=>"Los mensajes se estan enviando."]);
        
      }
      
    
}
