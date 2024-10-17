<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnToAuditoriaAnualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auditoria_anuals', function (Blueprint $table) {
            $table->dropColumn('tipo');
            $table->dropColumn('auditorlider_id');
            $table->dropColumn('team_id');
            $table->dropColumn('observaciones');
            $table->dropColumn('dias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auditoria_anuals', function (Blueprint $table) {
            //
        });
    }
}
