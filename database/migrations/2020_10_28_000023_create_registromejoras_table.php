<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistromejorasTable extends Migration
{
    public function up()
    {
        Schema::create('registromejoras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->string('prioridad')->nullable();
            $table->string('clasificacion')->nullable();
            $table->longText('descripcion')->nullable();
            $table->longText('participantes')->nullable();
            $table->longText('recursos')->nullable();
            $table->longText('beneficios')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
