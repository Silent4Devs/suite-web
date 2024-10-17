<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenciasSgsisTable extends Migration
{
    public function up()
    {
        Schema::create('evidencias_sgsis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('objetivodocumento');
            $table->string('arearesponsable')->nullable();
            $table->date('fechadocumento')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
