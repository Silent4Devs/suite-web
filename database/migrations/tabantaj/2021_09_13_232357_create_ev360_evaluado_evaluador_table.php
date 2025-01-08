<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEv360EvaluadoEvaluadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev360_evaluado_evaluador', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('evaluado_id');
            $table->integer('evaluador_id');
            $table->integer('evaluacion_id');
            $table->foreign('evaluado_id')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('evaluador_id')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ev360_evaluado_evaluador');
    }
}
