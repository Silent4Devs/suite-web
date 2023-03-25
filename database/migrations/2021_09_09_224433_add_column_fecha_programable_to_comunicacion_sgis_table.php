<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFechaProgramableToComunicacionSgisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comunicacion_sgis', function (Blueprint $table) {
            $table->date('fecha_programable')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comunicacion_sgis', function (Blueprint $table) {
            $table->dropColumn('fecha_programable')->nullable();
        });
    }
}
