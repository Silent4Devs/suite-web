<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecursoUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('recurso_user', function (Blueprint $table) {
            $table->unsignedInteger('recurso_id');
            $table->foreign('recurso_id', 'recurso_id_fk_2484751')->references('id')->on('recursos')->onDelete('cascade');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_2484751')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
