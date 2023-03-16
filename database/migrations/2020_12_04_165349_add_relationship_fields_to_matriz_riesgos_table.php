<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMatrizRiesgosTable extends Migration
{
    public function up()
    {
        Schema::table('matriz_riesgos', function (Blueprint $table) {
            $table->unsignedInteger('controles_id')->nullable();
            $table->foreign('controles_id', 'controles_fk_2702087')->references('id')->on('controles');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2702092')->references('id')->on('teams');
        });
    }
}
