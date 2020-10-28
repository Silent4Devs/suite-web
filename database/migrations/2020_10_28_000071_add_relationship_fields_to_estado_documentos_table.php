<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEstadoDocumentosTable extends Migration
{
    public function up()
    {
        Schema::table('estado_documentos', function (Blueprint $table) {
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484643')->references('id')->on('teams');
        });
    }
}
