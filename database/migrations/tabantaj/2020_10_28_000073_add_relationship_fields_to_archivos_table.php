<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToArchivosTable extends Migration
{
    public function up()
    {
        Schema::table('archivos', function (Blueprint $table) {
            $table->integer('carpeta_id');
            $table->foreign('carpeta_id', 'carpeta_fk_2484631')->references('id')->on('carpeta');
            $table->integer('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484636')->references('id')->on('teams');
            $table->integer('estado_id')->nullable();
            $table->foreign('estado_id', 'estado_fk_2484644')->references('id')->on('estado_documentos');
        });
    }
}
