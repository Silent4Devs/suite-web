<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPlanBaseActividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_base_actividades', function (Blueprint $table) {
            $table->foreign('actividad_fase_id')->references('id')->on('actividad_fases');
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
            $table->dropForeign('plan_base_actividades_actividad_fase_id_foreign');
        });
    }
}
