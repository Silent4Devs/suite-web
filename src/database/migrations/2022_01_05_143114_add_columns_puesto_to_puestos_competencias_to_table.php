<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsPuestoToPuestosCompetenciasToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puestos_competencias_to', function (Blueprint $table) {
            $table->unsignedInteger('puestos_id');
            $table->foreign('puestos_id')->references('id')->on('puestos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('puestos_competencias_to', function (Blueprint $table) {
            //
        });
    }
}
