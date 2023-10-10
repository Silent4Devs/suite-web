<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAuditoriaInternasTable extends Migration
{
    public function up()
    {
        Schema::table('auditoria_internas', function (Blueprint $table) {
            $table->unsignedInteger('auditorlider_id')->nullable();
            $table->foreign('auditorlider_id', 'auditorlider_fk_2444007')->references('id')->on('users');
            $table->unsignedInteger('equipoauditoria_id')->nullable();
            $table->foreign('equipoauditoria_id', 'equipoauditoria_fk_2444008')->references('id')->on('users');
            $table->unsignedInteger('clausulas_id')->nullable();
            $table->foreign('clausulas_id', 'clausulas_fk_2445010')->references('id')->on('controles');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484766')->references('id')->on('teams');
        });
    }
}
