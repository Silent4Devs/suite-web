<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisisBrechasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisis_brechas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->date('fecha');
            $table->string('porcentaje_implementacion');
            $table->unsignedBigInteger('id_elaboro')->nullable();
            $table->foreign('id_elaboro')->references('id')->on('empleados');
            $table->integer('estatus');
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
        Schema::dropIfExists('analisis_brechas');
    }
}
