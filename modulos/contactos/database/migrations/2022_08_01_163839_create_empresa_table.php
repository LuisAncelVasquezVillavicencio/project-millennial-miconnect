<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->bigIncrements('empresa_id');
            $table->string('empresa_nombre');
            $table->string('empresa_ruc', 100)->unique();
            $table->string('empresa_pagina_oficial')->nullable();
            $table->string('empresa_url_logo')->nullable();
            $table->string('empresa_correo', 100)->unique();
            $table->string('empresa_telefono', 20)->unique();
            $table->string('empresa_descripcion')->nullable();
            $table->string('empresa_direccion')->nullable();
            $table->string('empresa_gps_latitud')->nullable();
            $table->string('empresa_gps_longitud')->nullable();
            $table->string('estado')->nullable()->default("activo");
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
        Schema::dropIfExists('empresa');
    }
}

//php artisan migrate --path=/database/migrations/2022_08_01_163839_create_empresa_table.php

//php artisan migrate:rollback