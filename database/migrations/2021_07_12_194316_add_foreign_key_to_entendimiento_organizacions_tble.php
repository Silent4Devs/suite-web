<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToEntendimientoOrganizacionsTble extends Migration
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
            $table->unsignedBigInteger('id_elabora')->nullable();
            $table->foreign('id_elabora')->references('id')->on('empleados');
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
            $table->dropForeign('entendimiento_organizacions_id_elabora_foreign');
            $table->dropColumn('id_elabora');
        });
    }
}
