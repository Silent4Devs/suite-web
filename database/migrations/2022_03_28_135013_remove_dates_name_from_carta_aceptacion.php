<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDatesNameFromCartaAceptacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carta_aceptacion', function (Blueprint $table) {
            $table->dropColumn('legal');
            $table->dropColumn('cumplimiento');
            $table->dropColumn('operacional');
            $table->dropColumn('reputacional');
            $table->dropColumn('financiero');
            $table->dropColumn('tecnologico');
            $table->dropColumn('activo_folio');
            $table->dropColumn('nombre_activo');
            $table->dropColumn('criticidad_activo');
            $table->dropColumn('confidencialidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carta_aceptacion', function (Blueprint $table) {
            //
        });
    }
}
