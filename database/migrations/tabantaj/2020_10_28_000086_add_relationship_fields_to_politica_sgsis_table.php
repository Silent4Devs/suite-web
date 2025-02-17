<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPoliticaSgsisTable extends Migration
{
    public function up()
    {
        Schema::table('politica_sgsis', function (Blueprint $table) {
            $table->integer('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484747')->references('id')->on('teams');
        });
    }
}
