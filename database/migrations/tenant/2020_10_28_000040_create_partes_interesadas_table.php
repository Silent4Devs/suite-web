<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartesInteresadasTable extends Migration
{
    public function up()
    {
        Schema::create('partes_interesadas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('parteinteresada');
            $table->string('requisitos');
            $table->longText('clausala')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
