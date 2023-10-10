<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToComiteseguridadsTable extends Migration
{
    public function up()
    {
        Schema::table('comiteseguridads', function (Blueprint $table) {
            $table->unsignedInteger('personaasignada_id')->nullable();
            $table->foreign('personaasignada_id', 'personaasignada_fk_2433168')->references('id')->on('users');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484745')->references('id')->on('teams');
        });
    }
}
