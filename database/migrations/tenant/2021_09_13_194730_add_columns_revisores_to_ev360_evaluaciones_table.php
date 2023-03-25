<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsRevisoresToEv360EvaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ev360_evaluaciones', function (Blueprint $table) {
            $table->boolean('autoevaluacion')->after('estatus')->default(1);
            $table->boolean('evaluado_por_jefe')->after('autoevaluacion')->default(1);
            $table->boolean('evaluado_por_equipo_a_cargo')->after('evaluado_por_jefe')->default(1);
            $table->boolean('evaluado_por_misma_area')->after('evaluado_por_equipo_a_cargo')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ev360_evaluaciones', function (Blueprint $table) {
            //
        });
    }
}
