<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsToPlanAuditoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_auditoria', function (Blueprint $table) {
            $table->dropColumn('id_equipo_auditores');
            $table->dropColumn('team_id');
            $table->dropColumn('fecha_id');
            $table->dropColumn('descripcion');
            $table->dropColumn('equipoauditor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_auditoria', function (Blueprint $table) {
            //
        });
    }
}
