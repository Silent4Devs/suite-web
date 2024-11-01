<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAutorizadoToRegistrarVisitantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrar_visitantes', function (Blueprint $table) {
            $table->boolean('autorizado')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registrar_visitantes', function (Blueprint $table) {
            $table->dropColumn('autorizado');
        });
    }
}
