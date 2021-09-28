<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoIncidentesTable extends Migration
{
    public function up()
    {
        Schema::create('estado_incidentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('estado');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
