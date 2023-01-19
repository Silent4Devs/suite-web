<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlosariosTable extends Migration
{
    public function up()
    {
        Schema::create('glosarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('concepto');
            $table->longText('definicion')->nullable();
            $table->longText('explicacion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
