<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsFechafinToAuditoriaAnualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auditoria_anuals', function (Blueprint $table) {
            // $table->dropForeign('auditorlider_id');
            /* $table->unsignedInteger('auditorlider_id')->nullable(); */
            $table->foreign('auditorlider_id')->references('id')->on('empleados');
            $table->datetime('fechainicio')->change();
            $table->datetime('fechafin')->nullable();
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
