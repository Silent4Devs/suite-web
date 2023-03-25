<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTratamientoRiesgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tratamiento_riesgos', function (Blueprint $table) {
            $table->string('identificador')->nullable();
            $table->longText('descripcionriesgo')->nullable();
            $table->string('tipo_riesgo')->nullable();
            $table->float('riesgototal', 5, 2)->nullable();
            $table->string('riesgo_total_residual')->nullable();
            $table->unsignedInteger('id_proceso')->nullable();
            $table->foreign('id_proceso')->references('id')->on('procesos');
            $table->string('inversion_requerida')->nullable();
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
