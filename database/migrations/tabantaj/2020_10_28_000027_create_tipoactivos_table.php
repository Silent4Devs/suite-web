<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoactivosTable extends Migration
{
    public function up()
    {
        Schema::create('tipoactivos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo');
            $table->string('subtipo');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
