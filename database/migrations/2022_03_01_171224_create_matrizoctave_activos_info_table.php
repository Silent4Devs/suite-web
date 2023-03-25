<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrizoctaveActivosInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matrizoctave_activos_info', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_ai')->nullable();
            $table->integer('valor_criticidad')->nullable();
            $table->string('contenedor_activos')->nullable();
            $table->unsignedInteger('id_amenaza')->nullable();
            $table->unsignedInteger('id_octave')->nullable();
            $table->unsignedInteger('id_vulnerabilidad')->nullable();
            $table->longText('escenario_riesgo')->nullable();
            $table->unsignedBigInteger('id_custodio')->nullable();
            $table->unsignedBigInteger('id_dueno')->nullable();
            $table->integer('confidencialidad')->nullable();
            $table->integer('disponibilidad')->nullable();
            $table->integer('integridad')->nullable();
            $table->integer('evaluacion_riesgo')->nullable();
            $table->foreign('id_amenaza')->references('id')->on('amenazas');
            $table->foreign('id_vulnerabilidad')->references('id')->on('vulnerabilidads');
            $table->foreign('id_custodio')->references('id')->on('empleados');
            $table->foreign('id_dueno')->references('id')->on('empleados');
            $table->foreign('id_octave')->references('id')->on('matriz_octave');
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
        Schema::dropIfExists('matrizoctave_activos_info');
    }
}
