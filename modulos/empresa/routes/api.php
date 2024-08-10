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
    'prefix' => 'v1/empresa'
], function () {
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::post('crear', 'EmpresaController@crear')->name('crear');
        Route::post('editar', 'EmpresaController@editar')->name('editar');
        Route::post('obtener', 'EmpresaController@obtener')->name('obtener');
        Route::post('listar', 'EmpresaController@listar')->name('listar');
        Route::post('eliminar', 'EmpresaController@eliminar')->name('eliminar');
    });
});


