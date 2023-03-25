<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrizOctaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriz_octave', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vp')->nullable();
            $table->unsignedInteger('id_area')->nullable();
            $table->unsignedInteger('id_sede')->nullable();
            $table->string('servicio')->nullable();
            $table->unsignedInteger('id_proceso')->nullable();
            $table->unsignedInteger('activo_id')->nullable();
            $table->integer('operacional')->nullable();
            $table->integer('cumplimiento')->nullable();
            $table->integer('legal')->nullable();
            $table->integer('reputacional')->nullable();
            $table->integer('tecnologico')->nullable();
            $table->integer('valor')->nullable();
            $table->unsignedInteger('id_analisis')->nullable();
            $table->foreign('id_analisis')->references('id')->on('analisis_de_riesgo');
            $table->foreign('id_area')->references('id')->on('areas');
            $table->foreign('id_sede')->references('id')->on('sedes');
            $table->foreign('id_proceso')->references('id')->on('procesos');
            $table->foreign('activo_id')->references('id')->on('activos');
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
        Schema::dropIfExists('matriz_octave');
    }
}
