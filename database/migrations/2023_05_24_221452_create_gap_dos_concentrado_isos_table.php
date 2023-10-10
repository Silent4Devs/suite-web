<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGapDosConcentradoIsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'gap_dos_concentrado_isos',
            function (Blueprint $table) {
                $table->id();
                $table->string('valoracion')->nullable();
                $table->longText('evidencia')->nullable();
                $table->longText('recomendacion')->nullable();
                //foreign
                $table->unsignedBigInteger('id_gap_dos_catalogo')->nullable();
                $table->foreign('id_gap_dos_catalogo')->references('id')->on('gap_dos_catalogo_isos');
                //foreign
                $table->unsignedBigInteger('id_analisis_brechas')->nullable();
                $table->foreign('id_analisis_brechas')->references('id')->on('analisis_brechas_isos');
                $table->timestamps();
                $table->softDeletes();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gap_dos_concentrado_isos');
    }
}
