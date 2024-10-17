<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentesVacacionesEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidentes_vacaciones_empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('incidente_id')->nullable();
            $table->unsignedBigInteger('empleado_id')->nullable();
            $table->foreign('incidente_id')->references('id')->on('incidentes_vacaciones')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('incidentes_vacaciones_empleados');
    }
}
