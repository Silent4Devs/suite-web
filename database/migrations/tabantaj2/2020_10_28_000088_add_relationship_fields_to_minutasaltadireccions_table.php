<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMinutasaltadireccionsTable extends Migration
{
    public function up()
    {
        Schema::table('minutasaltadireccions', function (Blueprint $table) {
            $table->unsignedInteger('responsablereunion_id')->nullable();
            $table->foreign('responsablereunion_id', 'responsablereunion_fk_2433199')->references('id')->on('users');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484746')->references('id')->on('teams');
        });
    }
}
