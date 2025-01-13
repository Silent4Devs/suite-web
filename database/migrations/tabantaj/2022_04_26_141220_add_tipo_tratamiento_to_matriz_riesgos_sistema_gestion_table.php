<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoTratamientoToMatrizRiesgosSistemaGestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matriz_riesgos_sistema_gestion', function (Blueprint $table) {
            $table->string('tipo_tratamiento')->nullable();
            $table->longText('aceptar_transferir')->nullable();
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
