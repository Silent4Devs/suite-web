<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjetivosseguridadsTable extends Migration
{
    public function up()
    {
        Schema::create('objetivosseguridads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('objetivoseguridad');
            $table->string('indicador')->nullable();
            $table->date('anio')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
