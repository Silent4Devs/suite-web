<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesheetHorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheet_horas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->boolean('facturable')->nullable();

            $table->unsignedBigInteger('timesheet_id')->nullable();
            $table->foreign('timesheet_id')->references('id')->on('timesheet')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('proyecto_id')->nullable();
            $table->foreign('proyecto_id')->references('id')->on('timesheet_proyectos')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('tarea_id')->nullable();
            $table->foreign('tarea_id')->references('id')->on('timesheet_tareas')->onUpdate('cascade')->onDelete('cascade');

            $table->string('horas_lunes')->nullable();
            $table->string('horas_martes')->nullable();
            $table->string('horas_miercoles')->nullable();
            $table->string('horas_jueves')->nullable();
            $table->string('horas_viernes')->nullable();
            $table->string('horas_sabado')->nullable();
            $table->string('horas_domingo')->nullable();

            $table->longText('descripcion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timesheet_horas');
    }
}
