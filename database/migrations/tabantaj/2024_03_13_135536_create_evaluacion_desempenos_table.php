<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evaluacion_desempenos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->longText('descripcion')->nullable();
            $table->boolean('activar_objetivos');
            $table->float('porcentaje_objetivos');
            $table->boolean('activar_competencias');
            $table->float('porcentaje_competencias');

            $table->string('tipo_periodo')->nullable();
            $table->integer('estatus');
            $table->integer('autor_id');

            $table->foreign('autor_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluacion_desempenos');
    }
};
