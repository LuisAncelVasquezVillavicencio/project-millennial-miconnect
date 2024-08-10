<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Colas;
use App\Totalmensajes;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use App\Config_wassap;


class ColasController extends Controller
{
    /**
     * Display a listing of the resource.
     *https://laravel.com/docs/7.x/http-client
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $alerta = array();
        $alerta['notice']  = null;
        $alerta['warning'] = null;
        $alerta['error']   = null ;
        
        $COLAS_ESPERA_HORAS = intval(env('COLAS_ESPERA_HORAS', '0'));
        $MINUTOS_ESPERA=$COLAS_ESPERA_HORAS*60;
       // $baseUrl = env('API_ENDPOINT');
        
       // $client = new Client(['base_uri' => 'https://eu47.chat-api.com']);
    //    $res = $client->request('GET', '/instance139591/showMessagesQueue?token=5qzsfqhpihfr8rze');
     //   $data = json_decode($res->getBody());
        
        
        /*$response = Http::get('https://eu47.chat-api.com/instance139591/showMessagesQueue', [
            'token' => '5qzsfqhpihfr8rze'
        ]);*/
        $now  = Carbon::now();
        $instancias = Config_wassap::first();
        $colas = Colas::where("TOKEN",$instancias->API_KEY)->count();
        
        $API_CHAT_TOKEN = $instancias->API_KEY;
        $totalmensajes = Totalmensajes::where('TOKEN',$instancias->API_KEY)->first();
        // dd($totalmensajes);
        $jobs = DB::table('jobs')->count();
        $date_squeduler = Carbon::parse($totalmensajes->UPDATE_SQUEDULER);
        $diffInMinutes = $date_squeduler->diffInMinutes($now);
        $porcentaje_reinicio= round((($diffInMinutes/$MINUTOS_ESPERA)*100),0);
        $porcentaje_trabajo_envio = round((($totalmensajes->TOTAL_MESSAGES/150)*100),0);
        return view('colas.colas', compact('colas','totalmensajes','jobs','now','porcentaje_reinicio','porcentaje_trabajo_envio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\colas  $colas
     * @return \Illuminate\Http\Response
     */
    public function show(colas $colas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\colas  $colas
     * @return \Illuminate\Http\Response
     */
    public function edit(colas $colas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\colas  $colas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, colas $colas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\colas  $colas
     * @return \Illuminate\Http\Response
     */
    public function destroy(colas $colas)
    {
        //
    }
}
