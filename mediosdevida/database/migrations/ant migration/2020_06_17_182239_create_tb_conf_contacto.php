<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbConfContacto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_conf_contacto', function (Blueprint $table) {
            $table->id();
            $table->string('NOMBRE_GRUPO',50);
            $table->text('DESCRIPCION_GRUPO')->nullable();
            $table->string('NOM_CATEGORIA_1',25)->nullable();
            $table->string('NOM_CATEGORIA_2',25)->nullable();
            $table->string('NOM_CATEGORIA_3',25)->nullable();
            $table->string('NOM_CATEGORIA_4',25)->nullable();
            $table->string('NOM_CATEGORIA_5',25)->nullable();
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
        Schema::dropIfExists('tb_conf_contacto');
    }
}
