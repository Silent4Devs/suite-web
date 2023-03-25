<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEstatusPlanTrabajosTable extends Migration
{
    public function up()
    {
        Schema::table('estatus_plan_trabajos', function (Blueprint $table) {
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484471')->references('id')->on('teams');
        });
    }
}
