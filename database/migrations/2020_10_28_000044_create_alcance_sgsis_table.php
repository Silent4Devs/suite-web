<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlcanceSgsisTable extends Migration
{
    public function up()
    {
        Schema::create('alcance_sgsis', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('alcancesgsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}