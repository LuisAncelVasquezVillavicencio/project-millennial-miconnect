<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaPruebasAddColumnas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('mensajes_pruebas', function($table) {
             $table->string("numero",100);
             $table->longText("caption");
             $table->string("nombrechat",100);
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
        Schema::table('mensajes_pruebas', function($table) {
            $table->dropColumn('nombrechat');
            $table->dropColumn('caption');
            $table->dropColumn('numero');
        });
       
        
    }
}
