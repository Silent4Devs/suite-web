<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRiesgosoportunidadesTable extends Migration
{
    public function up()
    {
        Schema::table('riesgosoportunidades', function (Blueprint $table) {
            $table->unsignedInteger('control_id')->nullable();
            $table->foreign('control_id', 'control_fk_2444942')->references('id')->on('controles');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484749')->references('id')->on('teams');
        });
    }
}
