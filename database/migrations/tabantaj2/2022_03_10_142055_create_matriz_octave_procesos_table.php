<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrizOctaveProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriz_octave_procesos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_proceso')->nullable();
            $table->integer('nivel_riesgo')->nullable();
            $table->unsignedInteger('id_direccion')->nullable();
            $table->unsignedInteger('servicio_id')->nullable();
            $table->integer('operacional')->nullable();
            $table->integer('cumplimiento')->nullable();
            $table->integer('legal')->nullable();
            $table->integer('reputacional')->nullable();
            $table->integer('tecnologico')->nullable();
            $table->integer('impacto')->nullable();
            $table->unsignedInteger('id_activos_informacion')->nullable();
            $table->integer('promedio')->nullable();
            $table->foreign('id_proceso')->references('id')->on('procesos');
            $table->foreign('id_direccion')->references('id')->on('areas');
            $table->foreign('id_activos_informacion')->references('id')->on('activosInformacion');
            $table->foreign('servicio_id')->references('id')->on('matriz_octave_servicios');
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
        Schema::dropIfExists('matriz_octave_procesoso');
    }
}
