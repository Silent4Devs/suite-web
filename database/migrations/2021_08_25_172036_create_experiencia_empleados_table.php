<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienciaEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencia_empleados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado_id')->nullable();
            $table->string('empresa')->nullable();
            $table->string('puesto')->nullable();
            $table->date('inicio_mes')->nullable();
            $table->date('inicio_año')->nullable();
            $table->date('fin_año')->nullable();
            $table->date('fin_mes')->nullable();
            $table->string('duracion')->nullable();
            $table->longText('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('empleado_id')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experiencia_empleados');
    }
}
