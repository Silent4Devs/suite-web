<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsToOrganizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizacions', function (Blueprint $table) {
            $table->dropColumn('hora_laboral_inicio');
            $table->dropColumn('hora_laboral_fin');
            $table->dropColumn('dia_inicio');
            $table->dropColumn('dia_fin');
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
            //
        });
    }
}
