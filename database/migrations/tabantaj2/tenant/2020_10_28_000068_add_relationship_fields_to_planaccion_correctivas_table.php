<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPlanaccionCorrectivasTable extends Migration
{
    public function up()
    {
        Schema::table('planaccion_correctivas', function (Blueprint $table) {
            $table->unsignedInteger('accioncorrectiva_id')->nullable();
            $table->foreign('accioncorrectiva_id', 'accioncorrectiva_fk_2475271')->references('id')->on('accion_correctivas');
            $table->unsignedInteger('responsable_id')->nullable();
            $table->foreign('responsable_id', 'responsable_fk_2475273')->references('id')->on('users');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484769')->references('id')->on('teams');
        });
    }
}
