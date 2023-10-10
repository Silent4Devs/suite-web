<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicadoresSgsisTable extends Migration
{
    public function up()
    {
        Schema::create('indicadores_sgsis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('control');
            $table->string('titulo')->nullable();
            $table->longText('formula')->nullable();
            $table->string('frecuencia')->nullable();
            $table->string('unidadmedida')->nullable();
            $table->string('meta')->nullable();
            $table->string('semaforo')->nullable();
            $table->float('enero', 5, 2)->nullable();
            $table->float('febrero', 5, 2)->nullable();
            $table->float('marzo', 5, 2)->nullable();
            $table->float('abril', 5, 2)->nullable();
            $table->float('mayo', 5, 2)->nullable();
            $table->float('junio', 5, 2)->nullable();
            $table->float('julio', 5, 2)->nullable();
            $table->float('agosto', 5, 2)->nullable();
            $table->float('septiembre', 5, 2)->nullable();
            $table->float('octubre', 5, 2)->nullable();
            $table->float('noviembre', 5, 2)->nullable();
            $table->float('diciembre', 5, 2)->nullable();
            $table->string('anio')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
