<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropocionaInformacionAiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propociona_informacion_aia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->string('puesto')->nullable();
            $table->string('correo_electronico')->nullable();
            $table->integer('extencion')->nullable();
            $table->string('ubicacion')->nullable();
            $table->integer('interno_externo')->nullable();
            $table->unsignedBigInteger('cuestionario_id')->nullable();
            $table->foreign('cuestionario_id')->references('id')->on('analisis_aia')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propociona_informacion_aia');
    }
}
