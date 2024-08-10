<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     
    /*ID_ENVIO ejemplo
    true_51941695131@c.us_3EB0BBF5E10DEA7FA7BA
    true_51941695131@c.us_3EB05E9E192F2D21A2B6
    true_51941695131@c.us_3EB01D56BFBBE68288D
    **/
    public function up()
    {
        Schema::create('tb_sent', function (Blueprint $table) {
            $table->string('ID_ENVIO',50); 
            $table->unsignedInteger('ID_CONTACTO');
            $table->text('BODY')->nullable();
            $table->text('AUTHOR')->nullable();
            $table->integer('TIME')->nullable();
            $table->text('CHATID')->nullable(); 
            $table->string('TYPE',50)->nullable();  
            $table->text('SENDERNAME')->nullable();
            $table->text('CAPTION')->nullable();
            $table->text('QUOTEDMSGBODY')->nullable();
            $table->text('QUOTEDMSGID')->nullable();
            $table->text('CHATNAME')->nullable();
            $table->text('ETIQUETA');
            $table->text('KEY');
            $table->text('TYPE_MSM'); 
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
        Schema::dropIfExists('tb_sent');
    }
}
