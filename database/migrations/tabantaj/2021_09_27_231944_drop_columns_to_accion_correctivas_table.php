<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsToAccionCorrectivasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accion_correctivas', function (Blueprint $table) {
            $table->dropColumn('area_id');
            $table->dropColumn('proceso_id');
            $table->dropColumn('activo_id');
        });

        Schema::table('accion_correctivas', function (Blueprint $table) {
            $table->text('areas')->nullable();
            $table->text('procesos')->nullable();
            $table->text('activos')->nullable();
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
