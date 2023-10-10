<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTratamientoRiesgosTable extends Migration
{
    public function up()
    {
        Schema::table('tratamiento_riesgos', function (Blueprint $table) {
            $table->unsignedInteger('responsable_id')->nullable();
            $table->foreign('responsable_id', 'responsable_fk_2438665')->references('id')->on('users');
            $table->unsignedInteger('control_id')->nullable();
            $table->foreign('control_id', 'control_fk_2444996')->references('id')->on('controles');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484762')->references('id')->on('teams');
        });
    }
}
