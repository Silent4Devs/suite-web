<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEv360ObjetivosComentariosPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev360_objetivos_comentarios_pivot', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('objetivo_id');
            $table->foreign('objetivo_id')->references('id')->on('ev360_objetivos')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('comentario_id');
            $table->foreign('comentario_id')->references('id')->on('ev360_objetivos_comentarios')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ev360_objetivos_comentarios_pivot');
    }
}
