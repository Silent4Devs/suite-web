<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsAsignadaToComiteseguridadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comiteseguridads', function (Blueprint $table) {
            $table->unsignedBigInteger('id_asignada')->nullable();
            $table->foreign('id_asignada')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comiteseguridads', function (Blueprint $table) {
            //
        });
    }
}
