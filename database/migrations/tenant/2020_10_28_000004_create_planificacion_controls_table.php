<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanificacionControlsTable extends Migration
{
    public function up()
    {
        Schema::create('planificacion_controls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('activo');
            $table->longText('descripcion')->nullable();
            $table->string('vulnerabilidad')->nullable();
            $table->string('amenaza')->nullable();
            $table->string('confidencialidad')->nullable();
            $table->string('integridad')->nullable();
            $table->string('disponibilidad')->nullable();
            $table->string('probabilidad')->nullable();
            $table->string('impacto')->nullable();
            $table->string('nivelriesgo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
