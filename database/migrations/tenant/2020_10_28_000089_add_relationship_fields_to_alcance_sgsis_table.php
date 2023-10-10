<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAlcanceSgsisTable extends Migration
{
    public function up()
    {
        Schema::table('alcance_sgsis', function (Blueprint $table) {
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484744')->references('id')->on('teams');
        });
    }
}
