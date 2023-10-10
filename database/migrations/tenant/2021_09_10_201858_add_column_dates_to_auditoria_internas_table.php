<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDatesToAuditoriaInternasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auditoria_internas', function (Blueprint $table) {
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->dropColumn('fechaauditoria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auditoria_internas', function (Blueprint $table) {
            //
        });
    }
}
