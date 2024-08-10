<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhatsappSendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whatsappSend', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('metodo');
            $table->string('idNumTel')->nullable();
            $table->string('to')->nullable();
            $table->string('recipient_type')->nullable();
            $table->string('preview_url')->nullable();
            $table->string('body')->nullable();
            $table->string('type')->nullable();
            $table->string('mediaMessagesId')->nullable();
            $table->string('mediaMessagesUrl')->nullable();
            $table->string('mediaMessagesCaption')->nullable();
            $table->string('mediaMessagesFilename')->nullable();
            $table->string('locationMessagesLongitude')->nullable();
            $table->string('locationMessagesLatitude')->nullable();
            $table->string('locationMessagesName')->nullable();
            $table->string('locationMessagesAddress')->nullable();
            $table->string('contacts_input')->nullable();
            $table->string('contacts_wa_id')->nullable();
            $table->string('messages_id')->nullable();
            $table->string('id_user')->nullable();
            $table->string('idWhatsappConfig')->nullable();
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
        Schema::dropIfExists('whatsappSend');
    }
}

//php artisan migrate --path=/database/migrations/2022_08_01_163839_create_empresa_table.php

//php artisan migrate:rollback