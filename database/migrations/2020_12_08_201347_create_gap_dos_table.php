<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGapDosTable extends Migration
{
    public function up()
    {
        Schema::create('gap_dos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('anexo_indice')->nullable();
            $table->string('control')->nullable();
            $table->string('descripcion_control')->nullable();
            $table->string('valoracion')->nullable();
            $table->string('evidencia')->nullable();
            $table->string('recomendacion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
