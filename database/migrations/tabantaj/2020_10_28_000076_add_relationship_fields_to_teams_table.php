<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTeamsTable extends Migration
{
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->integer('owner_id')->nullable();
            $table->foreign('owner_id', 'owner_fk_2480335')->references('id')->on('users');
        });
    }
}
