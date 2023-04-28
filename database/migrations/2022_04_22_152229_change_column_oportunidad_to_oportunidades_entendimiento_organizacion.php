<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnOportunidadToOportunidadesEntendimientoOrganizacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oportunidades_entendimiento_organizacion', function (Blueprint $table) {
            $table->text('oportunidad')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('oportunidades_entendimiento_organizacion', function (Blueprint $table) {
            //
        });
    }
}
