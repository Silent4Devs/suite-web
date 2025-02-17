<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactosEmergenciaEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos_emergencia_empleados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('empleado_id');
            $table->string('nombre');
            $table->string('telefono');
            $table->string('parentesco');
            $table->timestamps();

            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contactos_emergencia_empleados');
    }
}
