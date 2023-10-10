<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinutasaltadireccionsTable extends Migration
{
    public function up()
    {
        Schema::create('minutasaltadireccions', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('objetivoreunion')->nullable();
            $table->string('arearesponsable')->nullable();
            $table->date('fechareunion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
