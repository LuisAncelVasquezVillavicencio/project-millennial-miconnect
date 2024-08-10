<?php


use Illuminate\Support\Facades\Route;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SentStatusExport;
use App\Exports\ContactosExport;
use App\Exports\RecibeExport;
use App\Exports\BotExport1;
use App\Exports\BotExport2;
use App\Exports\BotExport3;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 //DB::listen(function($query){
   //Imprimimos la consulta ejecutada
  //echo "<pre> {$query->sql } </pre>";
 // });


Route::get('/mensajes', function () {
    return view('Mensajes');
});


Route::post("/chat","whatsController@Chat_Response");

Route::get("/mensajes_api","whatsController@Read_messages_recibidos");



Route::get("/test","whatsController@test");

// Route::get('/login', function () {
//     return view('Login.login');
// })->name('login');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Route::get('/',"HomeController@index");

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/home', function () {
//     return view('Home.home');
// })->name('home');

Route::get('/contactos','ContactoController@show' )->name('contactos');
Route::post('/modal_contacto','ContactoController@modal_contacto' )->name('modal_contacto');
Route::post('/obtener_campos','ContactoController@Obtener_campos' )->name('Obtener_campos');
Route::post('/guardar_contacto/{condicion}','ContactoController@store' )->name('guardar_contacto');
Route::post('/eliminar_contacto',"ContactoController@destroy")->name("eliminar_contacto");
Route::any('/importar_contacto',"ContactoController@import")->name("importar_contacto");
Route::get('/exportar/{id_grupo}',function ($id_grupo) {
    return (new ContactosExport($id_grupo,"exportar"))->download('Listado_contactos.xlsx');
})->name("exportar_contacto");
Route::post('/up_file',"ContactoController@up_file")->name("up_file");
Route::get('/modelo/{id_grupo}',function ($id_grupo){
    return (new ContactosExport($id_grupo,"modelo"))->download('Modelo.xlsx');
})->name("descarga_modelo");
Route::post('/guardar_archivo',"ContactoController@Guardar_masivo")->name("guardar_archivo");


Route::get('/multimedia',"MultimediaController@index")->name("multimedia_index");
Route::post('/multimedia/eliminar',"MultimediaController@destroy")->name("multimedia_eliminar");
Route::post('/multimedia/up',"MultimediaController@save")->name("multimedia_guardar");
Route::post('/multimedia/mostrar',"MultimediaController@show")->name("multimedia_mostrar");


Route::get('/grupos',"GrupoController@show")->name('grupos');
//Nueva version
Route::get('/grupos/{id}',"GrupoController@show_groups")->name('grupo_categoria');
Route::get('/nuevo_grupo',"GrupoController@create")->name('creargrupo');
Route::get('/editar_grupo/{id}',"GrupoController@edit")->name('editargrupo');

Route::post('/guardar_grupo',"GrupoController@store")->name("guardar_grupo");
Route::post('/grupo/update',"GrupoController@update")->name("update_grupo");
Route::post('/eliminar_grupo',"GrupoController@destroy")->name("eliminar_grupo");


Route::get('/plantillas',"PlantillaController@show")->name('plantillas');


Route::get('/colas',"ColasController@index")->name('colas');

Auth::routes(['register' => false , 'reset' => false ] );






Route::get('/recive', 'ReciveController@index')->name('recive');


Route::get('/sent1',  'SentController@sent1')->name('Sent_1'); //seleccionar grupo
// Route::post('/sent2', 'SentController@sent2')->name('Sent_2');
// Route::post('/sent3', 'SentController@sent3')->name('Sent_3');
//Rutas actualizadas
Route::any('/sent2/{id_grupo}', 'SentController@sent2')->name('Sent_2');
Route::any('/sent3', 'SentController@sent3')->name('Sent_3');
Route::post('/sent4', 'SentController@sent4')->name('Sent_4');


Route::get('/home', 'HomeController@index')->name('home');




Route::get('/report',  'ReportController@index')->name('report');
Route::post('/report_1',  'ReportController@report_1')->name('report_1');
Route::post('/report_2',  'ReportController@report_2')->name('report_2');

//encuestas
Route::get('/reportbot1',  'ReportBotController@IndexReporte1')->name('IndexReporte1');
Route::get('/reportbot2',  'ReportBotController@IndexReporte2')->name('IndexReporte2');
Route::get('/reportbot3',  'ReportBotController@IndexReporte3')->name('IndexReporte3');
//Reportes de bots encuestas
//Trama: Salud Mental - Auto cuidado
//Encuesta de satisfacción
//Test "Tu media Naranja"
Route::get('/report_salud_mental',  'ReportController@index')->name('report_salud_mental');
Route::get('/report_satisfaccion',  'ReportController@index')->name('report_satisfaccion');
Route::get('/report_media_naranja',  'ReportController@index')->name('report_media_naranja');

Route::post('/getsentstatus',  'ReportController@ajax_GetSentStatus')->name('ajax_GetSentStatus');


/*LIMPIAR - REENVIO*/
Route::get('/report_1', 'ReportController@index');
//Route::get('/report_2', 'ReportController@index');
Route::get('/sent4', 'ReportController@index');

/*EXPORT*/
Route::get('export/export_status/{id_grupo}/{etiqueta}', function ($id_grupo,$etiqueta) {
    return (new SentStatusExport($id_grupo,$etiqueta))->download('status_mensajes_enviados.xlsx');
})->name('ExportSentStatusExport');

Route::get('export/export_recibe/', function () {
    return (new RecibeExport())->download('mensajes_recibidos.xlsx');
})->name('recibeExport');

//Pruebas Login api
Route::get('/instancia/auth','WhatsAuthController@status')->name("validar_qr");
Route::get('/instancia/Qr_code','WhatsAuthController@Qr_code');
// Route::get("/config_estado","WhatsAuthController@config")->name("config");
Route::post("/logout_whats","WhatsAuthController@logout")->name("logout_whats");
Route::post("/auth_uno","WhatsAuthController@status_un")->name("estado_uno");

//api login v2

Route::get("/config_estado","WhatsAuthController@config_v2")->name("config");
Route::any('/estado/validar_full','WhatsAuthController@status_full')->name("validar");
Route::any('/nueva_instancia','WhatsAuthController@modal_instancia')->name("mant_m");
Route::post('/guardar_instancia','WhatsAuthController@guardar_form')->name("guardar_form");
Route::post('/quitar_instancia','WhatsAuthController@quitar_instancia')->name("quitar_instancia");

Route::get('/sent3_instancia','SentController@sent3_instancia')->name("sent3_instancia");
Route::post('/status_conn','WhatsAuthController@status_conn')->name("validar_u");


//Sesion en espera
Route::post('con_sesion', function() {
    return 'OK'; 
});



Route::get('export/BotExport1/', function () {
    return (new BotExport1())->download('bot1.xlsx');
})->name('BotExport1');
Route::get('export/BotExport2/', function () {
    return (new BotExport2())->download('bot2.xlsx');
})->name('BotExport2');
Route::get('export/BotExport3/', function () {
    return (new BotExport3())->download('bot3.xlsx');
})->name('BotExport3');


Route::get("/Bolsa","BolsaController@index")->name("bolsa");

// agregando ruta de generacion del CSS.
Route::get('/generate_config_view', 'Config\View\ViewController@generate_config_view')->name('viewController.generate_config_view');


//BOT_NEW_GEN
Route::get('/bots',"botbetaController@index")->name("bot.admins");
Route::post('/bots/store',"botbetaController@store")->name("bot.create");
Route::get('/bots/update',"botbetaController@edit")->name("bot.edit");
Route::post('/bots/update',"botbetaController@update")->name("bot.update");
Route::post('/bots/delete/{id_p}',"botbetaController@destroy")->name("bot.destroy");

Route::post('/bots/welcome',"botbetaController@create_welcome")->name("bot.create_welcome");
Route::get('/bots/welcome/edit/id/{id}',"botbetaController@edit_welcome")->name("bot.edit_welcome");
Route::post('/bots/welcome/update/id/{id}',"botbetaController@update_welcome")->name("bot.update_welcome");

Route::get('/bots/{id}',"botbetaController@preguntas")->name("bot.pregunta");
Route::get('/bots/{id}/update',"botbetaController@edit_pregunta")->name("bot.pregunta_edit");
Route::post('/bots/{id}/create',"botbetaController@create_pregunta")->name("bot.pregunta_c");
Route::post('/bots/{id}/update',"botbetaController@update_pregunta")->name("bot.pregunta_e");
Route::post('/bots/{id}/destroy_pregunta',"botbetaController@preguntas_destroy")->name("bot.pregunta_destroy");

Route::get('/bots/{id}/answer',"botbetaController@opcion")->name("bot.opcion");
Route::get('/bots/{id}/answer/edit',"botbetaController@opcion_edit")->name("bot.opcion_edit");
Route::post('/bots/{id}/answer/create',"botbetaController@create_respuesta")->name("bot.respuesta_new");
Route::post('/bots/{id}/answer/update',"botbetaController@update_respuesta")->name("bot.respuesta_edit");
Route::post('/bots/{id}/answer/destroy',"botbetaController@delete_respuesta")->name("bot.respuesta_destroy");

Route::post('/bots/{id}/calc',"botbetaController@create_calc")->name("bot.calc");
Route::get('/bots/{id}/calc/edit',"botbetaController@edit_calc")->name("bot.calc_edit");
Route::post('/bots/{id}/calc/edit',"botbetaController@update_calc")->name("bot.calc_edit");
Route::post('/bots/{id}/calc/destroy',"botbetaController@destroy_calc")->name("bot.calc_destroy");


Route::get('/reporteria/{id}',"ReporteriaController@index")->name("bot.reporteria");
Route::get('/exportar/reporteria_01/{id}',"ReporteriaController@reporteria_01")->name("bot.reporteria_01");
Route::get('/exportar/reporteria_02/{id}',"ReporteriaController@reporteria_02")->name("bot.reporteria_02");
Route::get('/exportar/reporteria_03/{id}',"ReporteriaController@reporteria_03")->name("bot.reporteria_03");


Route::get('/configuracion/categorias',"CategoriasController@index")->name("config.categorias");
Route::post('/configuracion/categorias/create',"CategoriasController@store")->name("config.categorias.save");
Route::get('/configuracion/categorias/edit',"CategoriasController@edit")->name("config.categorias.edit");
Route::post('/configuracion/categorias/update',"CategoriasController@update")->name("config.categorias.update");
Route::post('/configuracion/categorias/delete',"CategoriasController@destroy")->name("config.categorias.delete");

Route::get('/configuracion/plantillas',"GPlantillaController@index")->name("config.plantillas");
Route::post('/configuracion/plantillas/create',"GPlantillaController@store")->name("config.plantillas.save");
Route::get('/configuracion/plantillas/edit',"GPlantillaController@edit")->name("config.plantillas.edit");
Route::post('/configuracion/plantillas/update',"GPlantillaController@update")->name("config.plantillas.update");
Route::post('/configuracion/plantillas/delete',"GPlantillaController@destroy")->name("config.plantillas.delete");

Route::get('/configuracion/instancias/list',"ConfigwassapController@index")->name("config.instancias");