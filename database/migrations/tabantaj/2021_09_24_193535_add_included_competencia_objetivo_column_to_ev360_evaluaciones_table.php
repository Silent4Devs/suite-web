<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIncludedCompetenciaObjetivoColumnToEv360EvaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ev360_evaluaciones', function (Blueprint $table) {
            $table->boolean('include_competencias')->default(true);
            $table->boolean('include_objetivos')->default(true);
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
