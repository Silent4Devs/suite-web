<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlesTable extends Migration
{
    public function up()
    {
        Schema::create('controles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero')->nullable();
            $table->string('control')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
