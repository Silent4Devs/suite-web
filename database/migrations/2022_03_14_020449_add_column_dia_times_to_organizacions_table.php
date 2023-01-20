<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDiaTimesToOrganizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizacions', function (Blueprint $table) {
            $table->string('dia_timesheet')->default('Viernes');
            $table->dropColumn('dia_timehseet');
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
            $table->dropColumn('dia_timesheet');
        });
    }
}
