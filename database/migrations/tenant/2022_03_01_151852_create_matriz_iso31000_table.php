<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrizIso31000Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriz_iso31000', function (Blueprint $table) {
            $table->increments('id');
            $table->string('proveedores')->nullable();
            $table->string('servicio')->nullable();
            $table->unsignedInteger('id_proceso')->nullable();
            $table->longText('descripcion_servicio')->nullable();
            $table->integer('estrategico')->nullable();
            $table->integer('operacional')->nullable();
            $table->integer('cumplimiento')->nullable();
            $table->integer('legal')->nullable();
            $table->integer('reputacional')->nullable();
            $table->integer('tecnologico')->nullable();
            $table->integer('valor')->nullable();
            $table->unsignedInteger('id_analisis')->nullable();
            $table->foreign('id_analisis')->references('id')->on('analisis_de_riesgo');
            $table->foreign('id_proceso')->references('id')->on('procesos');
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
        Schema::dropIfExists('matriz_iso31000');
    }
}
