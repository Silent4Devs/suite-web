<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnToPlanificacionControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planificacion_controls', function (Blueprint $table) {
            $table->dropColumn('activo');
            $table->dropColumn('vulnerabilidad');
            $table->dropColumn('amenaza');
            $table->dropColumn('confidencialidad');
            $table->dropColumn('integridad');
            $table->dropColumn('disponibilidad');
            $table->dropColumn('probabilidad');
            $table->dropColumn('impacto');
            $table->dropColumn('nivelriesgo');
            $table->dropColumn('dueno_id');
            $table->dropColumn('team_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planificacion_controls', function (Blueprint $table) {
            //
        });
    }
}
