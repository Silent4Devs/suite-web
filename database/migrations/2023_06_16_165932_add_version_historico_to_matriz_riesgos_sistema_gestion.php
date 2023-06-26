<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVersionHistoricoToMatrizRiesgosSistemaGestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matriz_riesgos_sistema_gestion', function (Blueprint $table) {
            //
            $table->boolean('version_historico')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matriz_riesgos_sistema_gestion', function (Blueprint $table) {
            //
        });
    }
}
