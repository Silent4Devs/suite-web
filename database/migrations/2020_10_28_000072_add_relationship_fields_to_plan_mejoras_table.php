<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPlanMejorasTable extends Migration
{
    public function up()
    {
        Schema::table('plan_mejoras', function (Blueprint $table) {
            $table->unsignedInteger('mejora_id')->nullable();
            $table->foreign('mejora_id', 'mejora_fk_2475319')->references('id')->on('registromejoras');
            $table->unsignedInteger('responsable_id')->nullable();
            $table->foreign('responsable_id', 'responsable_fk_2475321')->references('id')->on('users');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484772')->references('id')->on('teams');
        });
    }
}
