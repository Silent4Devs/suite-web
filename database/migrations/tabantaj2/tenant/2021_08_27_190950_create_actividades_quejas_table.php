<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesQuejasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_quejas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('queja_id');
            $table->string('actividad');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->string('prioridad');
            $table->string('tipo');
            $table->longText('comentarios');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('queja_id')->references('id')->on('quejas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividades_quejas');
    }
}
