<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbGrupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_grupo', function (Blueprint $table) {
            $table->increments('ID_GRUPO');
            $table->string('TITULO',255);
            $table->string('DESCRIPCION',500);
            $table->string('NOM_GRUPO_1',255)->nullable();
            $table->string('NOM_GRUPO_2',255)->nullable();
            $table->string('NOM_GRUPO_3',255)->nullable();
            $table->string('NOM_GRUPO_4',255)->nullable();
            $table->string('NOM_GRUPO_5',255)->nullable();
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
        Schema::dropIfExists('tb_grupo');
    }
}
