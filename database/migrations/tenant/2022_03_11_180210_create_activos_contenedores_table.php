<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivosContenedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activos_contenedores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activo_id');
            $table->unsignedBigInteger('contenedor_id');
            $table->foreign('activo_id')->references('id')->on('activos_informacion')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('contenedor_id')->references('id')->on('matriz_octave_contenedores')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('activos_contenedores');
    }
}
