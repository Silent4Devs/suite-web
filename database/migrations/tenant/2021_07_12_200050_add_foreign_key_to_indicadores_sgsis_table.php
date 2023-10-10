<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToIndicadoresSgsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indicadores_sgsis', function (Blueprint $table) {
            $table->unsignedInteger('id_proceso')->nullable();
            $table->foreign('id_proceso')->references('id')->on('procesos');
            $table->unsignedBigInteger('id_empleado')->nullable();
        });

        Schema::table('indicadores_sgsis', function ($table) {
            $table->foreign('id_empleado')->references('id')->on('empleados')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indicadores_sgsis', function (Blueprint $table) {
            //
        });
    }
}
