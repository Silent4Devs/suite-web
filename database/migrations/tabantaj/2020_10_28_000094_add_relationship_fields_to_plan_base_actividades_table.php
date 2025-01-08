<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPlanBaseActividadesTable extends Migration
{
    public function up()
    {
        Schema::table('plan_base_actividades', function (Blueprint $table) {
            $table->integer('responsable_id')->nullable();
            $table->foreign('responsable_id', 'responsable_fk_2410049')->references('id')->on('users');
            $table->integer('colaborador_id')->nullable();
            $table->foreign('colaborador_id', 'colaborador_fk_2410050')->references('id')->on('users');
            $table->integer('actividad_padre_id')->nullable();
            $table->foreign('actividad_padre_id', 'actividad_padre_fk_2475385')->references('id')->on('plan_base_actividades');
            $table->integer('ejecutar_id')->nullable();
            $table->foreign('ejecutar_id', 'ejecutar_fk_2475395')->references('id')->on('enlaces_ejecutars');
            $table->integer('estatus_id')->nullable();
            $table->foreign('estatus_id', 'estatus_fk_2484561')->references('id')->on('estatus_plan_trabajos');
            $table->integer('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484804')->references('id')->on('teams');
        });
    }
}
