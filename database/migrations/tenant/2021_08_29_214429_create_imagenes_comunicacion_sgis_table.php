<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagenesComunicacionSgisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagenes_comunicacion_sgis', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('comunicacion_id')->nullable();
            $table->string('imagen')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('comunicacion_id')->references('id')->on('comunicacion_sgis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagenes_comunicacion_sgis');
    }
}
