<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGapLogroDosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gap_logro_dos', function (Blueprint $table) {
            $table->id();
            $table->string('control-uno')->nullable();
            $table->string('control-dos')->nullable();
            $table->string('anexo_indice')->nullable();
            $table->longText('anexo_politica')->nullable();
            $table->longText('anexo_descripcion')->nullable();
            $table->string('valoracion')->nullable();
            $table->longText('evidencia')->nullable();
            $table->longText('recomendacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gap_logro_dos');
    }
}
