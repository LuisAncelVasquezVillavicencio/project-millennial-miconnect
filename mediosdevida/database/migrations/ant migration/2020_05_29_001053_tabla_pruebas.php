<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaPruebas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('mensajes_pruebas', function (Blueprint $table) {
            $table->id();
            $table->string('id_mensaje');
            $table->string('autor',100);
            $table->string('NombreAutor',100);
            $table->longText('Mensaje');
            $table->string('fromMe');
            $table->longText('Archivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
