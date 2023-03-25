<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('organizacion_id')->nullable();
            $table->foreign('organizacion_id', 'organizacion_fk_2474597')->references('id')->on('organizaciones');
            $table->unsignedInteger('area_id')->nullable();
            $table->foreign('area_id', 'area_fk_2474598')->references('id')->on('areas');
            $table->unsignedInteger('puesto_id')->nullable();
            $table->foreign('puesto_id', 'puesto_fk_2474599')->references('id')->on('puestos');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2480336')->references('id')->on('teams');
        });
    }
}
