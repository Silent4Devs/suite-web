<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisisDeRiesgoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisis_de_riesgo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('tipo');
            $table->date('fecha');
            $table->string('porcentaje_implementacion');
            $table->unsignedBigInteger('id_empleado')->nullable();
            $table->foreign('id_empleado')->references('id')->on('empleados');
            $table->integer('estatus');
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
        Schema::dropIfExists('analisis_de_riesgo');
    }
}
