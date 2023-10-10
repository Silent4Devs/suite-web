<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuejasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quejas', function (Blueprint $table) {
            $table->id();

            $table->string('anonimo')->nullable();

            $table->string('estatus')->nullable();

            $table->unsignedBigInteger('empleado_quejo_id')->nullable();

            $table->string('quejado')->nullable();
            $table->foreign('empleado_quejo_id')->references('id')->on('empleados');

            $table->string('area_quejado')->nullable();
            $table->string('colaborador_quejado')->nullable();
            $table->string('proceso_quejado')->nullable();
            $table->string('externo_quejado')->nullable();

            $table->string('titulo')->nullable();
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
        Schema::dropIfExists('quejas');
    }
}
