<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToObjetivosseguridadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objetivosseguridads', function (Blueprint $table) {
            $table->foreign('id_empleado')->references('id')->on('matriz_requisito_legales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('objetivosseguridads', function (Blueprint $table) {
            //
        });
    }
}
