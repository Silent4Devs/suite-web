<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMaterialIsoVeinticientesTable extends Migration
{
    public function up()
    {
        Schema::table('material_iso_veinticientes', function (Blueprint $table) {
            $table->integer('arearesponsable_id')->nullable();
            $table->foreign('arearesponsable_id', 'arearesponsable_fk_2474624')->references('id')->on('areas');
            $table->integer('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484756')->references('id')->on('teams');
        });
    }
}
