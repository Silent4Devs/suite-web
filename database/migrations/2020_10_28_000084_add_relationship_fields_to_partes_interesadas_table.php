<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPartesInteresadasTable extends Migration
{
    public function up()
    {
        Schema::table('partes_interesadas', function (Blueprint $table) {
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484742')->references('id')->on('teams');
        });
    }
}
