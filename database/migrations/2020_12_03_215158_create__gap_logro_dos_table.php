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
            $table->string('anexo_indice');
            $table->string('anexo_politica');
            $table->longText('anexo_descripcion');
            $table->integer('estado');
            $table->longText('evidencia');
            $table->timestamps();
        });

        Schema::create('gap_logro_uno', function (Blueprint $table) {
            $table->id();
            $table->string('entregable');
            $table->string('valoracion');
            $table->longText('evidencia');
            $table->integer('recomendacion');
            $table->longText('evidencia');
            $table->timestamps();
        });

        Schema::create('gap_logro_tres', function (Blueprint $table) {
            $table->id();
            $table->string('pregunta');
            $table->string('valoracion');
            $table->longText('evidencia');
            $table->integer('recomendacion');
            $table->boolean()->nullable();
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
        Schema::dropIfExists('gap_logro_uno');
        Schema::dropIfExists('gap_logro_dos');
        Schema::dropIfExists('gap_logro_tres');
    }
}
