<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEvidenciasSgsisTable extends Migration
{
    public function up()
    {
        Schema::table('evidencias_sgsis', function (Blueprint $table) {
            $table->unsignedInteger('responsable_id')->nullable();
            $table->foreign('responsable_id', 'responsable_fk_2436332')->references('id')->on('users');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484734')->references('id')->on('teams');
        });
    }
}
