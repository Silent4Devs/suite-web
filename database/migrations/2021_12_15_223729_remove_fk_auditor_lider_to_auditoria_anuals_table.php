<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveFkAuditorLiderToAuditoriaAnualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auditoria_anuals', function (Blueprint $table) {
            // $table->dropForeign('auditorlider_fk_2475218');
            $table->dropForeign('auditoria_anuals_auditorlider_id_foreign');
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
