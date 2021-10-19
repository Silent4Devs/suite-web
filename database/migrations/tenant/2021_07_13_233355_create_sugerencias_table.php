<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSugerenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sugerencias', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('estatus')->default('nuevo');
            $table->longText('descripcion');

            $table->string('area_sugerencias')->nullable();
            $table->string('proceso_sugerencias')->nullable();

            $table->dateTime('fecha_cierre')->nullable();

            $table->unsignedBigInteger('empleado_sugirio_id')->nullable();
            $table->foreign('empleado_sugirio_id')->references('id')->on('empleados');

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
        Schema::dropIfExists('sugerencias');
    }
}
