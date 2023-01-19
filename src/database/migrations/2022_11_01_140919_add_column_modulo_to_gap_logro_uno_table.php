<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnModuloToGapLogroUnoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gap_logro_uno', function (Blueprint $table) {
            $table->longText('modulo')->after('pregunta')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gap_logro_uno', function (Blueprint $table) {
            //
        });
    }
}
