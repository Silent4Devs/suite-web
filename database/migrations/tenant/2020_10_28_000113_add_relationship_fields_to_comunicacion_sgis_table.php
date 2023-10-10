<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToComunicacionSgisTable extends Migration
{
    public function up()
    {
        Schema::table('comunicacion_sgis', function (Blueprint $table) {
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484757')->references('id')->on('teams');
        });
    }
}
