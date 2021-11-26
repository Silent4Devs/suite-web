<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSedesTable extends Migration
{
    public function up()
    {
        Schema::table('sedes', function (Blueprint $table) {
            $table->unsignedInteger('organizacion_id')->nullable();
            $table->foreign('organizacion_id', 'organizacion_fk_2474605')->references('id')->on('organizacions');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484802')->references('id')->on('teams');
        });
    }
}
