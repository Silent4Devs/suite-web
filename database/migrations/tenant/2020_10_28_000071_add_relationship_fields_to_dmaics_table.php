<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDmaicsTable extends Migration
{
    public function up()
    {
        Schema::table('dmaics', function (Blueprint $table) {
            $table->unsignedInteger('mejora_id')->nullable();
            $table->foreign('mejora_id', 'mejora_fk_2475307')->references('id')->on('registromejoras');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2484771')->references('id')->on('teams');
        });
    }
}
