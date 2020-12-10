<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGapTresTable extends Migration
{
    public function up()
    {
        Schema::create('gap_tres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pregunta')->nullable();
            $table->string('valoracion')->nullable();
            $table->string('evidencia')->nullable();
            $table->string('recomendacion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
