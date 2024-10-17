<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEv360ObjetivosCalificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev360_objetivos_calificaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('meta_alcanzada');
            $table->unsignedTinyInteger('calificacion');
            $table->unsignedBigInteger('objetivo_id');
            $table->foreign('objetivo_id')->references('id')->on('ev360_objetivos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ev360_objetivos_calificaciones');
    }
}
