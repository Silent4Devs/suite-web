<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosPlanificacionControlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados_planificacion_control', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('planificacion_id');
            $table->unsignedBigInteger('empleado_id');
            $table->foreign('planificacion_id')->references('id')->on('planificacion_controls');
            $table->foreign('empleado_id')->references('id')->on('empleados');
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
        Schema::dropIfExists('empleados_planificacion_control');
    }
}
