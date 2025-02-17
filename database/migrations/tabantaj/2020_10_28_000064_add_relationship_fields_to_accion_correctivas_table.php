<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAccionCorrectivasTable extends Migration
{
    public function up()
    {
        Schema::table('accion_correctivas', function (Blueprint $table) {
            $table->integer('nombrereporta_id')->nullable();
            $table->foreign('nombrereporta_id', 'nombrereporta_fk_2475251')->references('id')->on('users');
            $table->integer('puestoreporta_id')->nullable();
            $table->foreign('puestoreporta_id', 'puestoreporta_fk_2475252')->references('id')->on('puestos');
            $table->integer('nombreregistra_id')->nullable();
            $table->foreign('nombreregistra_id', 'nombreregistra_fk_2475253')->references('id')->on('users');
            $table->integer('puestoregistra_id')->nullable();
            $table->foreign('puestoregistra_id', 'puestoregistra_fk_2475254')->references('id')->on('puestos');
            $table->integer('responsable_accion_id')->nullable();
            $table->foreign('responsable_accion_id', 'responsable_accion_fk_2475264')->references('id')->on('users');
            $table->integer('nombre_autoriza_id')->nullable();
            $table->foreign('nombre_autoriza_id', 'nombre_autoriza_fk_2475265')->references('id')->on('users');
            $table->integer('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484768')->references('id')->on('teams');
        });
    }
}
