<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnlacesEjecutarsTable extends Migration
{
    public function up()
    {
        Schema::create('enlaces_ejecutars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ejecutar')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('enlace')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
