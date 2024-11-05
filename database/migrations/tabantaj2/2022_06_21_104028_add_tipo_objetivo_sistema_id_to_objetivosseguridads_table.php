<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoObjetivoSistemaIdToObjetivosseguridadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objetivosseguridads', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_objetivo_sistema_id')->nullable();
            $table->foreign('tipo_objetivo_sistema_id')->references('id')->on('tipo_objetivo_sistema');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('objetivosseguridads', function (Blueprint $table) {
            $table->dropForeign(['tipo_objetivo_sistema_id']);
            $table->dropColumn('tipo_objetivo_sistema_id');
        });
    }
}
