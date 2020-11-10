<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEnlacesEjecutarsTable extends Migration
{
    public function up()
    {
        Schema::table('enlaces_ejecutars', function (Blueprint $table) {
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484803')->references('id')->on('teams');
        });
    }
}
