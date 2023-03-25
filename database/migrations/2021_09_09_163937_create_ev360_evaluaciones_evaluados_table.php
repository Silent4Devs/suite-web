<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEv360EvaluacionesEvaluadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev360_evaluaciones_evaluados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('evaluacion_id');
            $table->unsignedBigInteger('evaluado_id');

            $table->foreign('evaluacion_id')->references('id')->on('ev360_evaluaciones')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('evaluado_id')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ev360_evaluaciones_evaluados');
    }
}
