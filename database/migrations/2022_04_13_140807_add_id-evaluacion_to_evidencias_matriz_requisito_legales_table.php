<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdEvaluacionToEvidenciasMatrizRequisitoLegalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evidencias_matriz_requisito_legales', function (Blueprint $table) {
            $table->unsignedBigInteger('id_evaluacion')->nullable();
            $table->foreign('id_evaluacion')->references('id')->on('evaluacion_requisito_legal')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evidencias_matriz_requisito_legales', function (Blueprint $table) {
            //
        });
    }
}
