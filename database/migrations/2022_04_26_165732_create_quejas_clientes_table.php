<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuejasClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quejas_clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('proyectos_id');
            $table->string('puesto')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->string('estatus')->nullable();
            $table->string('area_quejado')->nullable();
            $table->string('colaborador_quejado')->nullable();
            $table->string('proceso_quejado')->nullable();
            $table->string('otro_quejado')->nullable();
            $table->string('titulo')->nullable();
            $table->datetime('fecha')->nullable();
            $table->date('fecha_cierre')->nullable();
            $table->string('ubicacion')->nullable();
            $table->longText('descripcion')->nullable();
            $table->longText('comentarios')->nullable();
            $table->foreign('cliente_id')->references('id')->on('timesheet_clientes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('proyectos_id')->references('id')->on('timesheet_proyectos')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('quejas_clientes');
    }
}
