<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::get('/NotAuthenticated', function () {
    return 'Not Authenticated';
})->name('NotAuthenticated');
 



Route::group([
    'prefix' => 'whatsapp'
], function () {
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::post('sendTextMessages', 'WhatsappController@sendTextMessages')->name('sendTextMessages');
        Route::post('sendMediaMessages', 'WhatsappController@sendMediaMessages')->name('sendMediaMessages');
        Route::post('sendLocationMessages', 'WhatsappController@sendLocationMessages')->name('sendLocationMessages');
        Route::post('sendTextMessagesTemplate', 'WhatsappController@sendTextMessagesTemplate')->name('sendTextMessagesTemplate');
        Route::post('listarMessagesTemplate', 'WhatsappController@listarMessagesTemplate')->name('listarMessagesTemplate');
        Route::post('obtenerEspacioTemplate', 'WhatsappController@obtenerEspacioTemplate')->name('obtenerEspacioTemplate');
        Route::post('eliminarTemplate', 'WhatsappController@eliminarTemplate')->name('eliminarTemplate');
        Route::post('crearMessagesTemplate', 'WhatsappController@crearMessagesTemplate')->name('crearMessagesTemplate');
        
    });
});


