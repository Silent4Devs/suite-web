<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumns3ToEntendimientoOrganizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entendimiento_organizacions', function (Blueprint $table) {
            //$table->foreign('elaboro_id')->references('id')->on('empleados');
            $table->string('analisis')->before('amenazas')->nullable();
            $table->date('fecha')->before('analisis')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entendimiento_organizacions', function (Blueprint $table) {
            $table->dropColumn('analisis');
            $table->dropColumn('fecha');
        });
    }
}
