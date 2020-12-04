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
