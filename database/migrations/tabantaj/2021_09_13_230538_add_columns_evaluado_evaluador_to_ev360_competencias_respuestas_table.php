<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsEvaluadoEvaluadorToEv360CompetenciasRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ev360_competencias_respuestas', function (Blueprint $table) {
            $table->integer('evaluado_id');
            $table->integer('evaluador_id');
            $table->foreign('evaluado_id')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('evaluador_id')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ev360_competencias_respuestas', function (Blueprint $table) {
            //
        });
    }
}
