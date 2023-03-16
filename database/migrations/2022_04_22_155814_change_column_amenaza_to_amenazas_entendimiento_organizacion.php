<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnAmenazaToAmenazasEntendimientoOrganizacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('amenazas_entendimiento_organizacion', function (Blueprint $table) {
            $table->text('amenaza')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('amenazas_entendimiento_organizacion', function (Blueprint $table) {
            //
        });
    }
}
