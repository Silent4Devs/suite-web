<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsPesosGeneralesToEv360EvaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ev360_evaluaciones', function (Blueprint $table) {
            $table->integer('peso_general_competencias')->default(50);
            $table->integer('peso_general_objetivos')->default(50);
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
