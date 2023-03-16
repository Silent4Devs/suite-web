<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivosInformacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activosInformacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identificador')->unique();
            $table->string('nombreVP');
            $table->string('duenoVP');
            $table->string('nombreDireccion');
            $table->string('custodioAIDirector');
            $table->string('activoInformacion');
            $table->string('formato');
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
        Schema::dropIfExists('activosInformacion');
    }
}
