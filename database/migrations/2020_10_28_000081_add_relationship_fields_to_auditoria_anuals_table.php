<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAuditoriaAnualsTable extends Migration
{
    public function up()
    {
        Schema::table('auditoria_anuals', function (Blueprint $table) {
            $table->unsignedInteger('auditorlider_id')->nullable();
            $table->foreign('auditorlider_id', 'auditorlider_fk_2475218')->references('id')->on('users');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484764')->references('id')->on('teams');
        });
    }
}
