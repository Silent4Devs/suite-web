<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCuestionarioAnalisisImpactoAddTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cuestionario_analisis_impacto', function (Blueprint $table) {
            $table->string('macroproceso')->nullable();
            $table->string('subproceso')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cuestionario_analisis_impacto', function (Blueprint $table) {
            //
        });
    }
}
