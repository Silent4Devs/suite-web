<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsRegistroToAccionCorrectivasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accion_correctivas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_registro')->nullable();
            $table->foreign('id_registro')->references('id')->on('empleados');
            $table->unsignedBigInteger('id_reporto')->nullable();
            $table->foreign('id_reporto')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accion_correctivas', function (Blueprint $table) {
            //
        });
    }
}
