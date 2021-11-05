<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPlanAuditoriaTable extends Migration
{
    public function up()
    {
        Schema::table('plan_auditoria', function (Blueprint $table) {
            $table->unsignedInteger('fecha_id')->nullable();
            $table->foreign('fecha_id', 'fecha_fk_2475237')->references('id')->on('auditoria_anuals');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484765')->references('id')->on('teams');
        });
    }
}
