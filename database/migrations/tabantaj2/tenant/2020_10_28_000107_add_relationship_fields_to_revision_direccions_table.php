<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRevisionDireccionsTable extends Migration
{
    public function up()
    {
        Schema::table('revision_direccions', function (Blueprint $table) {
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484767')->references('id')->on('teams');
        });
    }
}
