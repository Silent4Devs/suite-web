<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetenciasPorPuestoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev360_competencias_por_puesto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('puesto_id');
            $table->unsignedBigInteger('competencia_id');
            $table->integer('nivel_esperado');

            $table->foreign('puesto_id')->references('id')->on('puestos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ev360_competencias_por_puesto');
    }
}
