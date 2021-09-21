<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMejorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mejoras', function (Blueprint $table) {
            $table->id();

            $table->string('estatus')->default('nuevo');
            $table->dateTime('fecha_cierre')->nullable();

            $table->unsignedBigInteger('empleado_mejoro_id');
            $table->foreign('empleado_mejoro_id')->references('id')->on('empleados');

            $table->string('area_mejora')->nullable();
            $table->string('proceso_mejora')->nullable();

            $table->string('titulo');
            $table->string('tipo');
            $table->string('otro')->nullable();
            $table->longText('descripcion');
            $table->longText('beneficios');

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
        Schema::dropIfExists('mejoras');
    }
}
