<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliticaSgsisTable extends Migration
{
    public function up()
    {
        Schema::create('politica_sgsis', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('politicasgsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
