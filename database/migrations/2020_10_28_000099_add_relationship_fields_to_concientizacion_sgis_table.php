<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToConcientizacionSgisTable extends Migration
{
    public function up()
    {
        Schema::table('concientizacion_sgis', function (Blueprint $table) {
            $table->unsignedInteger('arearesponsable_id')->nullable();
            $table->foreign('arearesponsable_id', 'arearesponsable_fk_2474611')->references('id')->on('areas');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484754')->references('id')->on('teams');
        });
    }
}
