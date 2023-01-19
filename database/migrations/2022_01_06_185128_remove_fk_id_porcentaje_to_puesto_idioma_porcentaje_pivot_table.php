<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveFkIdPorcentajeToPuestoIdiomaPorcentajePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puesto_idioma_porcentaje_pivot', function (Blueprint $table) {
            $table->dropForeign('puesto_idioma_porcentaje_pivot_id_puesto_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('puesto_idioma_porcentaje_pivot', function (Blueprint $table) {
            //
        });
    }
}
