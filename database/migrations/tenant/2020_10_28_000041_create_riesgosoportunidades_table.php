<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiesgosoportunidadesTable extends Migration
{
    public function up()
    {
        Schema::create('riesgosoportunidades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('aplicaorganizacion')->nullable();
            $table->longText('justificacion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
