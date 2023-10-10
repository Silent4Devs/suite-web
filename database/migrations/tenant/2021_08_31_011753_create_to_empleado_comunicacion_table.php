<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToEmpleadoComunicacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_comunicacion', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedInteger('comunicacion_id');
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->foreign('comunicacion_id')->references('id')->on('comunicacion_sgis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('to_empleado_comunicacion');
    }
}
