<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIncidentesDeSeguridadsTable extends Migration
{
    public function up()
    {
        Schema::table('incidentes_de_seguridads', function (Blueprint $table) {
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484326')->references('id')->on('teams');
            $table->unsignedInteger('estado_id')->nullable();
            $table->foreign('estado_id', 'estado_fk_2484444')->references('id')->on('estado_incidentes');
        });
    }
}
