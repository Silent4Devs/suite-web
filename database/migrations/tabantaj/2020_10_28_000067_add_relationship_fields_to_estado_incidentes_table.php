<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEstadoIncidentesTable extends Migration
{
    public function up()
    {
        Schema::table('estado_incidentes', function (Blueprint $table) {
            $table->integer('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484382')->references('id')->on('teams');
        });
    }
}
