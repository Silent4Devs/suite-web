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

            $table->string('anonimo')->nullable();

            $table->string('estatus')->nullable();

            $table->unsignedBigInteger('empleado_denuncio_id')->nullable();
            $table->foreign('empleado_denuncio_id')->references('id')->on('empleados');

            $table->unsignedBigInteger('empleado_denunciado_id')->nullable();
            $table->foreign('empleado_denunciado_id')->references('id')->on('empleados');

            $table->string('tipo')->nullable();

            $table->date('fecha')->nullable();
            $table->date('fecha_cierre')->nullable();

            $table->string('sede')->nullable();
            $table->string('ubicacion')->nullable();

            $table->longText('descripcion')->nullable();
            $table->string('evidencia')->nullable();

            $table->longText('comentarios')->nullable();

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
