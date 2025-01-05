<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkIdMatrizRequisitoLegalesToEvidenciasMatrizRequisitoLegalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evidencias_matriz_requisito_legales', function (Blueprint $table) {
            $table->foreign('id_matriz_requisito')->references('id')->on('matriz_requisito_legales');
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
