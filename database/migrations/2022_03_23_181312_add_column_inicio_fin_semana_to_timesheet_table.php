<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInicioFinSemanaToTimesheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('timesheet', function (Blueprint $table) {
            $table->string('inicio_semana')->default('Lunes');
            $table->string('fin_semana')->default('Domingo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timesheet', function (Blueprint $table) {
            $table->dropColumn('inicio_semana');
            $table->dropColumn('fin_semana');
        });
    }
}
