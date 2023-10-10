<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsToAnalisisAccionCorrectivaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('analisis_accion_correctiva', function (Blueprint $table) {
            $table->longText('problema_porque')->nullable()->change();
            $table->longText('porque_1')->nullable()->change();
            $table->longText('porque_2')->nullable()->change();
            $table->longText('porque_3')->nullable()->change();
            $table->longText('porque_4')->nullable()->change();
            $table->longText('porque_5')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('analisis_accion_correctiva', function (Blueprint $table) {
            //
        });
    }
}
