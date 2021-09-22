<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnReportaToRegistromejorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registromejoras', function (Blueprint $table) {
            $table->unsignedBigInteger('id_reporta')->nullable();
            $table->foreign('id_reporta')->references('id')->on('empleados');
            $table->unsignedBigInteger('id_responsable')->nullable();
            $table->foreign('id_responsable')->references('id')->on('empleados');
            $table->unsignedBigInteger('id_participantes')->nullable();
            $table->foreign('id_participantes')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registromejoras', function (Blueprint $table) {
            //
        });
    }
}
