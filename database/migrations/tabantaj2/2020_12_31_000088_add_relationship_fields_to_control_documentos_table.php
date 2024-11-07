<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToControlDocumentosTable extends Migration
{
    public function up()
    {
        Schema::table('control_documentos', function (Blueprint $table) {
            $table->integer('elaboro_id')->nullable();
            $table->foreign('elaboro_id', 'elaboro_fk_2893195')->references('id')->on('users');
            $table->integer('reviso_id')->nullable();
            $table->foreign('reviso_id', 'reviso_fk_2893196')->references('id')->on('users');
            $table->integer('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2893200')->references('id')->on('teams');
            $table->integer('estado_id')->nullable();
            $table->foreign('estado_id', 'estado_fk_2893208')->references('id')->on('estado_documentos');
        });
    }
}
