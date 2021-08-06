<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();
            $table->string('anonimo');
            $table->string('denunciado');
            $table->string('area_denunciado')->nullable();
            $table->string('tipo')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('evidencia')->nullable();

            $table->unsignedBigInteger('empleado_denuncio_id')->nullable();

            $table->foreign('empleado_denuncio_id')->references('id')->on('empleados');

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
        Schema::dropIfExists('denuncias');
    }
}
