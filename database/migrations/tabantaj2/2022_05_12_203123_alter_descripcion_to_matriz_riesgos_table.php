<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDescripcionToMatrizRiesgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matriz_riesgos', function (Blueprint $table) {
            $table->dropForeign('matriz_riesgos_activo_id_foreign');
            $table->foreign('activo_id')->references('id')->on('subcategoria_activos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matriz_riesgos', function (Blueprint $table) {
            //
        });
    }
}
