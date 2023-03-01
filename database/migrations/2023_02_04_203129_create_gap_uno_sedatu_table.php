<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGapUnoSedatuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gap_uno_sedatu', function (Blueprint $table) {
            $table->id();
            $table->longText('modulo')->nullable();
            $table->longText('pregunta')->nullable();
            $table->string('valoracion')->nullable();
            $table->longText('evidencia')->nullable();
            $table->longText('recomendacion')->nullable();
            $table->unsignedInteger('analisis_brechas_id')->nullable();
            $table->foreign('analisis_brechas_id')->references('id')->on('analisis_brecha_sedatu')->onDelete('SET NULL')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gap_uno_sedatu');
    }
}
