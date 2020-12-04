<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGapLogroUnoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gap_logro_uno', function (Blueprint $table) {
            $table->id();
            $table->string('entregable');
            $table->string('valoracion');
            $table->longText('evidencia');
            $table->integer('recomendacion');
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
    }
}
