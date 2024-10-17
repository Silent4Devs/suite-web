<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInformacionDocumetadasTable extends Migration
{
    public function up()
    {
        Schema::table('informacion_documetadas', function (Blueprint $table) {
            $table->unsignedInteger('elaboro_id')->nullable();
            $table->foreign('elaboro_id', 'elaboro_fk_2438586')->references('id')->on('users');
            $table->unsignedInteger('reviso_id')->nullable();
            $table->foreign('reviso_id', 'reviso_fk_2438587')->references('id')->on('users');
            $table->unsignedInteger('aprobacion_id')->nullable();
            $table->foreign('aprobacion_id', 'aprobacion_fk_2438588')->references('id')->on('users');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484759')->references('id')->on('teams');
        });
    }
}
