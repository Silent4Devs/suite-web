<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuestoIdiomaPorcentajePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puesto_idioma_porcentaje_pivot', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_language');
            $table->foreign('id_language')->references('id')->on('languages')->onDelete('cascade');
            $table->unsignedInteger('id_puesto');
            $table->foreign('id_puesto')->references('id')->on('puestos')->onDelete('cascade');
            $table->unsignedInteger('id_porcentaje');
            $table->foreign('id_porcentaje')->references('id')->on('porcentajes')->onDelete('cascade');
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
        Schema::dropIfExists('puesto_idioma_porcentaje_pivot');
    }
}
