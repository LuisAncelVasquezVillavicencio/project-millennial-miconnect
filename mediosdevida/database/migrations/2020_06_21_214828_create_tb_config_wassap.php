<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbConfigWassap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     
     /*
     INSERT INTO `tb_config_wassap` (`ID_WASSAP`,`PROPIETARIO`,`NUMERO`,`API_KEY`,`URL`,`created_at`,`updated_at`) VALUES (1,'MILLENNIAL','960451539','5qzsfqhpihfr8rze','https://eu47.chat-api.com/instance139591/',NULL,NULL);
     */
    public function up()
    {
        Schema::create('tb_config_wassap', function (Blueprint $table) {
            $table->increments('ID_WASSAP');
            $table->string('PROPIETARIO',255);
            $table->text('NUMERO');
            $table->text('API_KEY');
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
        Schema::dropIfExists('tb_config_wassap');
    }
}
