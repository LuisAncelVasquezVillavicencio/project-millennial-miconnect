<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbMultimedia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_multimedia', function (Blueprint $table) {
            $table->increments('ID_MULTIMEDIA');
            $table->string('TIPO',20);
            $table->text('NOMBRE_ORIGINAL');
            $table->text('NOMBRE_ARCHIVO');
            $table->text('FORMATO_ARCHIVO');
            $table->text('UB_FISICA');
            $table->text('URL');
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
        Schema::dropIfExists('tb_multimedia');
    }
}
