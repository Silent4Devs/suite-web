<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIndicadoresSgsisTable extends Migration
{
    public function up()
    {
        Schema::table('indicadores_sgsis', function (Blueprint $table) {
            $table->unsignedInteger('responsable_id')->nullable();
            $table->foreign('responsable_id', 'responsable_fk_2475190')->references('id')->on('users');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484763')->references('id')->on('teams');
        });
    }
}
