<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToMinutasaltadireccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('minutasaltadireccions', function (Blueprint $table) {
            $table->dropForeign('responsablereunion_fk_2433199');
            $table->unsignedBigInteger('responsablereunion_id')->change();
            $table->foreign('responsablereunion_id')->references('id')->on('empleados');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('minutasaltadireccions', function (Blueprint $table) {
            $table->dropForeign('responsablereunion_fk_2433199');
            $table->unsignedInteger('responsablereunion_id')->change();
            $table->foreign('responsablereunion_id', 'responsablereunion_fk_2433199')->references('id')->on('users');

        });
    }
}
