<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnIdentificadorToMatrizRiesgosSistemaGestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matriz_riesgos_sistema_gestion', function (Blueprint $table) {
            // $table->string('identificador')->unique(false)->nullable()->change();
            $table->dropUnique('matriz_riesgos_sistema_gestion_identificador_unique');
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
