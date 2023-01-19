<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionObjetivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev360_evaluacion_objetivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('objetivo_id');
            $table->unsignedBigInteger('evaluacion_id');
            $table->foreign('objetivo_id')->references('id')->on('ev360_objetivos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ev360_evaluacion_objetivos');
    }
}
