<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcesosOctaveHistoricosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procesos_octave_historicos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('proceso_id')->nullable();
            $table->unsignedInteger('matriz_id')->nullable();
            $table->json('historico');
            $table->date('fecha_registro')->nullable();
            $table->foreign('matriz_id')->references('id')->on('analisis_de_riesgo');
            $table->foreign('proceso_id')->references('id')->on('matriz_octave_procesos');
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
        Schema::dropIfExists('procesos_octave_historicos');
    }
}
