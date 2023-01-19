<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResetColumnEvaluadosObjetivoToEv360EvaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ev360_evaluaciones', function (Blueprint $table) {
            $table->string('evaluados_objetivo')->after('estatus')->default('all');
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
