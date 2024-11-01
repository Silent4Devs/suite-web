<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEv360CompetenciasRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev360_competencias_respuestas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('calificacion')->default(0);
            $table->longText('descripcion')->nullable();
            $table->unsignedBigInteger('competencia_id');
            $table->foreign('competencia_id')->references('id')->on('ev360_competencias')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ev360_competencias_respuestas');
    }
}
