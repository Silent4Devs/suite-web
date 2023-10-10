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
            if (Schema::hasColumn($table->getTable(), 'prioridad')) {
                $table->dropColumn('prioridad');
            }
            if (Schema::hasColumn($table->getTable(), 'estatus')) {
                $table->dropColumn('estatus');
            }
            if (Schema::hasColumn($table->getTable(), 'probabilidad')) {
                $table->dropColumn('probabilidad');
            }
            if (Schema::hasColumn($table->getTable(), 'impacto')) {
                $table->dropColumn('impacto');
            }
            if (Schema::hasColumn($table->getTable(), 'nivelriesgoresidual')) {
                $table->dropColumn('nivelriesgoresidual');
            }
            if (Schema::hasColumn($table->getTable(), 'id_reviso')) {
                $table->dropColumn('id_reviso');
            }
            if (Schema::hasColumn($table->getTable(), 'responsable_id')) {
                $table->dropColumn('responsable_id');
            }
            if (Schema::hasColumn($table->getTable(), 'control_id')) {
                $table->dropColumn('control_id');
            }
            if (Schema::hasColumn($table->getTable(), 'team_id')) {
                $table->dropColumn('team_id');
            }
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
