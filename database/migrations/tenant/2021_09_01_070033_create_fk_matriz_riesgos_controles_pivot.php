<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFkMatrizRiesgosControlesPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matriz_riesgos_controles_pivot', function (Blueprint $table) {
            $table->dropForeign('matriz_riesgos_controles_pivot_matriz_id_foreign');
            $table->dropForeign('matriz_riesgos_controles_pivot_controles_id_foreign');
            $table->foreign('matriz_id')->references('id')->on('matriz_riesgos')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('controles_id')->references('id')->on('declaracion_aplicabilidad')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fk_matriz_riesgos_controles_pivot');
    }
}
