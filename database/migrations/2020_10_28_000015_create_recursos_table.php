<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecursosTable extends Migration
{
    public function up()
    {
        Schema::create('recursos', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('cursoscapacitaciones')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
