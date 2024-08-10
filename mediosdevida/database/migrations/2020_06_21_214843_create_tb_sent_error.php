<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSentError extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_sent_error', function (Blueprint $table) {
            $table->increments('ID_SENT_ERROR');
            $table->unsignedInteger('ID_CONTACTO');
            $table->text('BODY')->nullable();
            $table->text('ETIQUETA')->nullable();
            $table->text('KEY')->nullable();
            $table->text('TYPE_MSM')->nullable(); 
            $table->text('ERROR')->nullable();
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
        Schema::dropIfExists('tb_sent_error');
    }
}
