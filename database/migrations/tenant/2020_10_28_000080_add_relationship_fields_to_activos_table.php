<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToActivosTable extends Migration
{
    public function up()
    {
        Schema::table('activos', function (Blueprint $table) {
            $table->unsignedInteger('dueno_id')->nullable();
            $table->foreign('dueno_id', 'dueno_fk_2438646')->references('id')->on('users');
            $table->unsignedInteger('tipoactivo_id')->nullable();
            $table->foreign('tipoactivo_id', 'tipoactivo_fk_2474600')->references('id')->on('tipoactivos');
            $table->unsignedInteger('subtipo_id')->nullable();
            $table->foreign('subtipo_id', 'subtipo_fk_2474601')->references('id')->on('tipoactivos');
            $table->unsignedInteger('ubicacion_id')->nullable();
            $table->foreign('ubicacion_id', 'ubicacion_fk_2474610')->references('id')->on('sedes');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484761')->references('id')->on('teams');
        });
    }
}
