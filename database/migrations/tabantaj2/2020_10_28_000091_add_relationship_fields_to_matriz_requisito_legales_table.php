<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMatrizRequisitoLegalesTable extends Migration
{
    public function up()
    {
        Schema::table('matriz_requisito_legales', function (Blueprint $table) {
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484743')->references('id')->on('teams');
        });
    }
}
