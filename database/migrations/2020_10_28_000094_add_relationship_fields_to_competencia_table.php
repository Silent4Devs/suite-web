<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCompetenciaTable extends Migration
{
    public function up()
    {
        Schema::table('competencia', function (Blueprint $table) {
            $table->unsignedInteger('nombrecolaborador_id');
            $table->foreign('nombrecolaborador_id', 'nombrecolaborador_fk_2436578')->references('id')->on('users');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484753')->references('id')->on('teams');
        });
    }
}
