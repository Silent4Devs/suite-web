<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetenciaTable extends Migration
{
    public function up()
    {
        Schema::create('competencia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('perfilpuesto')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
