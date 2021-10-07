<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActividadFaseIdToPlanBaseActividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_base_actividades', function (Blueprint $table) {
            // $table->unsignedInteger('actividad_fase_id')->nullable();

            $table->unsignedBigInteger('actividad_fase_id')->nullable();
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
            $table->dropColumn('actividad_fase_id');
        });
    }
}
