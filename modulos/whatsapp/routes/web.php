<?php

use Illuminate\Support\Facades\Route;

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







Route::get("/formSendTextMessages","ViewController@formSendTextMessages");
Route::get("/tableListarMessagesTemplate","ViewController@tableListarMessagesTemplate");
Route::get("/formCreateTemplateMessages","ViewController@formCreateTemplateMessages");
Route::get("/formSendTemplateMessages","ViewController@formSendTemplateMessages");

Route::get("/","ViewController@index");