<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecursosHumanosAiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recursos_humanos_aia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('empresa')->nullable();
            $table->string('nombre')->nullable();
            $table->string('a_paterno')->nullable();
            $table->string('a_materno')->nullable();
            $table->string('puesto')->nullable();
            $table->string('rol')->nullable();
            $table->integer('tel')->nullable();
            $table->string('correo')->nullable();
            $table->integer('escenario')->nullable();
            $table->unsignedBigInteger('cuestionario_id')->nullable();
            $table->foreign('cuestionario_id')->references('id')->on('analisis_aia')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('recursos_humanos_aia');
    }
}
