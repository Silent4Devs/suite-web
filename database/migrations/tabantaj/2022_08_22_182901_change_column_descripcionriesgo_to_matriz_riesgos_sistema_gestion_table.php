<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnDescripcionriesgoToMatrizRiesgosSistemaGestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matriz_riesgos_sistema_gestion', function (Blueprint $table) {
            $table->longText('descripcionriesgo')->change();
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
