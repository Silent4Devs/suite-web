<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatriz31000ActivosInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriz31000_activos_info', function (Blueprint $table) {
            $table->id();
            $table->string('contenedor_activos')->nullable();
            $table->unsignedInteger('id_amenaza')->nullable();
            $table->unsignedInteger('id_vulnerabilidad')->nullable();
            $table->unsignedInteger('id_matriz31000')->nullable();
            $table->longText('escenario_riesgo')->nullable();
            $table->integer('confidencialidad')->nullable();
            $table->integer('disponibilidad')->nullable();
            $table->integer('integridad')->nullable();
            $table->integer('evaluación_riesgo')->nullable();
            $table->unsignedInteger('activo_id')->nullable();
            $table->foreign('id_amenaza')->references('id')->on('amenazas');
            $table->foreign('id_vulnerabilidad')->references('id')->on('vulnerabilidads');
            $table->foreign('activo_id')->references('id')->on('activos');
            $table->foreign('id_matriz31000')->references('id')->on('matriz_iso31000');
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
        Schema::dropIfExists('matriz31000_activos_info');
    }
}
