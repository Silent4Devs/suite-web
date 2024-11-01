<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTratamientoRiesgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados_tratamiento_riesgos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('tratamiento_id');
            $table->unsignedBigInteger('empleado_id');
            $table->foreign('tratamiento_id')->references('id')->on('tratamiento_riesgos');
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
        Schema::dropIfExists('empleados_tratamiento_riesgos');
    }
}
