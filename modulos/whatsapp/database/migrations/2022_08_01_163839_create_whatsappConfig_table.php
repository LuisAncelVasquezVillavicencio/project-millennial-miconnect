<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhatsappConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('whatsappConfig', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('numero')->nullable();
            $table->string('idNumTel')->nullable();
            $table->string('idNumTelToken')->nullable();
            $table->string('whatsappBusinessAccountID')->nullable();
            $table->string('userAccessToken')->nullable();
            $table->string('id_user')->nullable();
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
        Schema::dropIfExists('whatsappConfig');
    }
}

//php artisan migrate --path=/database/migrations/2022_08_01_163839_create_empresa_table.php

//php artisan migrate:rollback