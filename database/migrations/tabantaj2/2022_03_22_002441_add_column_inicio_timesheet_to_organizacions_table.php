<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInicioTimesheetToOrganizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizacions', function (Blueprint $table) {
            $table->string('inicio_timesheet')->default('Lunes');
            $table->string('fin_timesheet')->default('Domingo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizacions', function (Blueprint $table) {
            $table->dropColumn('inicio_timesheet');
            $table->dropColumn('fin_timesheet');
        });
    }
}
