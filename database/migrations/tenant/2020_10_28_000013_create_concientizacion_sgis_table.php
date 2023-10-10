<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConcientizacionSgisTable extends Migration
{
    public function up()
    {
        Schema::create('concientizacion_sgis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('objetivocomunicado');
            $table->string('personalobjetivo')->nullable();
            $table->string('medio_envio')->nullable();
            $table->date('fecha_publicacion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
