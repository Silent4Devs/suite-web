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
    /*
        public function up()
        {
            Schema::table('minutasaltadireccions', function (Blueprint $table) {
                $table->unsignedBigInteger('responsable_id')->after('responsablereunion_id');
                $table->foreign('responsable_id')->references('id')->on('empleados');

                $table->unsignedBigInteger('responsable_id')->after('responsablereunion_id');
                $table->foreign('responsable_id')->references('id')->on('empleados');


            });
        }
    */
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('minutasaltadireccions', function (Blueprint $table) {
            $table->dropColumn('responsable_id');
        });
    }
}
