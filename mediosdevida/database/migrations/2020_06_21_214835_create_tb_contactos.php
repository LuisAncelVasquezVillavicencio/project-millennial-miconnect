<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbContactos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_contactos', function (Blueprint $table) {
            $table->increments('ID_CONTACTO');
            $table->unsignedInteger('ID_WASSAP');
            $table->unsignedInteger('ID_PAIS');
            $table->unsignedInteger('ID_GRUPO');
            $table->string('NUMERO',9);
            $table->string('NOMBRE',255);
            $table->string('APELLIDO',255)->nullable();
            $table->string('VAL_GRUPO1',500)->nullable();
            $table->string('VAL_GRUPO2',500)->nullable();
            $table->string('VAL_GRUPO3',500)->nullable();
            $table->string('VAL_GRUPO4',500)->nullable();
            $table->string('VAL_GRUPO5',500)->nullable();
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
        Schema::dropIfExists('tb_contactos');
    }
}
