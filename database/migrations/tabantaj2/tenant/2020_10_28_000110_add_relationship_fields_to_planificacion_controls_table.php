<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPlanificacionControlsTable extends Migration
{
    public function up()
    {
        Schema::table('planificacion_controls', function (Blueprint $table) {
            $table->unsignedInteger('dueno_id')->nullable();
            $table->foreign('dueno_id', 'dueno_fk_2438609')->references('id')->on('users');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484760')->references('id')->on('teams');
        });
    }
}
