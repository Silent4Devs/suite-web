<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTituloToComunicacionSgisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comunicacion_sgis', function (Blueprint $table) {
            $table->unsignedBigInteger('id_publico')->nullable();
            $table->date('fecha_publicacion')->nullable();
            $table->string('titulo')->nullable();
            $table->string('publicar_en')->nullable();
            $table->integer('habilitar')->nullable();
            $table->string('link')->nullable();
            $table->foreign('id_publico')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comunicacion_sgis', function (Blueprint $table) {
            $table->dropForeign('comunicacion_sgis_id_publico')->nullable();
        });

        Schema::table('comunicacion_sgis', function (Blueprint $table) {
            $table->dropColumn('fecha_publicacion')->nullable();
            $table->dropColumn('titulo')->nullable();
            $table->dropColumn('publicar_en')->nullable();
            $table->dropColumn('habilitar')->nullable();
            $table->dropColumn('link')->nullable();
            $table->dropColumn('id_publico')->nullable();
        });
    }
}
