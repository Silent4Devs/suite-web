<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsToTratamientoRiesgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tratamiento_riesgos', function (Blueprint $table) {
            $table->dropColumn('prioridad');
            $table->dropColumn('estatus');
            $table->dropColumn('probabilidad');
            $table->dropColumn('impacto');
            $table->dropColumn('nivelriesgoresidual');
            $table->dropColumn('id_reviso');
            $table->dropColumn('responsable_id');
            $table->dropColumn('control_id');
            $table->dropColumn('team_id');
            $table->dropColumn('responsable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tratamiento_riesgos', function (Blueprint $table) {
            //
        });
    }
}
