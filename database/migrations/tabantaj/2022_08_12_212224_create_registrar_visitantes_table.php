<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrarVisitantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrar_visitantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('empresa')->nullable();
            $table->string('dispositivo')->nullable();
            $table->string('serie')->nullable();
            $table->longText('motivo')->nullable();
            $table->longText('foto')->nullable();
            $table->string('tipo_visita')->nullable();
            $table->integer('empleado_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->boolean('registro_salida')->default(false);
            $table->dateTime('fecha_salida')->nullable();
            $table->longText('firma')->nullable();
            //foreign keys
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrar_visitantes');
    }
}
