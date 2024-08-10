<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbContacto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tb_contactos', function (Blueprint $table) {
            $table->id();
            $table->string('NUMERO_TELF',20);
            $table->string('GRUPO1',50)->nullable();
            $table->string('GRUPO2',50)->nullable();
            $table->string('GRUPO3',50)->nullable();
            $table->string('GRUPO4',50)->nullable();
            $table->string('GRUPO5',50)->nullable();
            $table->unsignedBigInteger('ID_GRUPO');
            $table->string('NOMBRE_CONTACTO',50)->nullable();
            $table->integer('ID_PAIS');
            $table->timestamps();
            
            $table->foreign('ID_GRUPO')->references('id')->on('tb_conf_contacto');
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
        Schema::dropIfExists('tb_contactos');
    }
}
