<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnPorcentajeImplementacionToAnalisisBrechasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('analisis_brechas', function (Blueprint $table) {
            $table->string('nombre')->nullable()->change();
            $table->date('fecha')->nullable()->change();
            $table->string('porcentaje_implementacion')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('analisis_brechas', function (Blueprint $table) {
            //
        });
    }
}
