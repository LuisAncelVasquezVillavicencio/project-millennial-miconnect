<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbRecive extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_recive', function (Blueprint $table) {
            $table->string('ID_RECIVE',100); 
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
            $table->string('USER_VIEW',1); 
            $table->text('ETIQUETA')->nullable(); 
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
        Schema::dropIfExists('tb_recive');
    }
}
