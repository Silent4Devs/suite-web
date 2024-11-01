<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsMatrizRiesgoToTratamientoRiesgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tratamiento_riesgos', function (Blueprint $table) {
            $table->unsignedBigInteger('matriz_sistema_gestion_id')->nullable();
            $table->foreign('matriz_sistema_gestion_id')->references('id')->on('matriz_riesgos_sistema_gestion');
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
