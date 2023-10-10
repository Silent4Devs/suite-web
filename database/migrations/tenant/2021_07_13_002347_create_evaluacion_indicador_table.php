<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionIndicadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacion_indicador', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no')->nullable();
            $table->string('evaluacion')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('resultado')->nullable();
            $table->unsignedInteger('id_indicador')->nullable();
            $table->foreign('id_indicador')->references('id')->on('indicadores_sgsis');
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
        Schema::dropIfExists('evaluacion_indicador');
    }
}
