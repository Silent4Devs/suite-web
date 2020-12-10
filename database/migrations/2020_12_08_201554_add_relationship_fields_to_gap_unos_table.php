<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToGapUnosTable extends Migration
{
    public function up()
    {
        Schema::table('gap_unos', function (Blueprint $table) {
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2757171')->references('id')->on('teams');
        });
    }
}
