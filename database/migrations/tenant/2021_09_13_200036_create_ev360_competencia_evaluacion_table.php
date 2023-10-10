<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEv360CompetenciaEvaluacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev360_competencia_evaluacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('competencia_id');
            $table->unsignedBigInteger('evaluacion_id');
            $table->foreign('competencia_id')->references('id')->on('ev360_competencias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('evaluacion_id')->references('id')->on('ev360_evaluaciones')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ev360_competencia_evaluacion');
    }
}
