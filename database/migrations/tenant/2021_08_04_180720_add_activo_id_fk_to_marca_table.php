<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActivoIdFkToMarcaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marca', function (Blueprint $table) {
            $table->foreign('activo_id')->references('id')->on('tipoactivos');
        });

        Schema::table('modelo', function (Blueprint $table) {
            $table->foreign('marca_id')->references('id')->on('marca');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marca', function (Blueprint $table) {
            //
        });
    }
}
