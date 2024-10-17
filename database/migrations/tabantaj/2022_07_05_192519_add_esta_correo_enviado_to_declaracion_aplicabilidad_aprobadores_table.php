<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstaCorreoEnviadoToDeclaracionAplicabilidadAprobadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('declaracion_aplicabilidad_aprobadores', function (Blueprint $table) {
            $table->boolean('esta_correo_enviado')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('declaracion_aplicabilidad_aprobadores', function (Blueprint $table) {
            //
        });
    }
}
