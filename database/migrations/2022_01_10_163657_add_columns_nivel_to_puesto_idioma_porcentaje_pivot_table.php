<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsNivelToPuestoIdiomaPorcentajePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puesto_idioma_porcentaje_pivot', function (Blueprint $table) {
            $table->string('nivel')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('puesto_idioma_porcentaje_pivot', function (Blueprint $table) {
            //
        });
    }
}
