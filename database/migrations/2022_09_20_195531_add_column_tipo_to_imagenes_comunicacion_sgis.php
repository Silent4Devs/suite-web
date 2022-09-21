<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTipoToImagenesComunicacionSgis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagenes_comunicacion_sgis', function (Blueprint $table) {
            $table->string('tipo')->default('imagen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagenes_comunicacion_sgis', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });
    }
}
