<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRegistromejorasTable extends Migration
{
    public function up()
    {
        Schema::table('registromejoras', function (Blueprint $table) {
            $table->unsignedInteger('nombre_reporta_id')->nullable();
            $table->foreign('nombre_reporta_id', 'nombre_reporta_fk_2475292')->references('id')->on('users');
            $table->unsignedInteger('responsableimplementacion_id')->nullable();
            $table->foreign('responsableimplementacion_id', 'responsableimplementacion_fk_2475297')->references('id')->on('users');
            $table->unsignedInteger('valida_id')->nullable();
            $table->foreign('valida_id', 'valida_fk_2475301')->references('id')->on('users');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484770')->references('id')->on('teams');
        });
    }
}
