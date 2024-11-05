<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveActividadPadreIdToPlanBaseActividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_base_actividades', function (Blueprint $table) {
            $table->dropForeign('actividad_padre_fk_2475385');
            $table->dropColumn('actividad_padre_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_base_actividades', function (Blueprint $table) {
            $table->unsignedInteger('actividad_padre_id')->nullable();
            $table->foreign('actividad_padre_id', 'actividad_padre_fk_2475385')->references('id')->on('plan_base_actividades');
        });
    }
}
