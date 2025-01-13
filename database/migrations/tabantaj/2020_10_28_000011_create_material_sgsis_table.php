<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialSgsisTable extends Migration
{
    public function up()
    {
        Schema::create('material_sgsis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('objetivo');
            $table->string('personalobjetivo')->nullable();
            $table->string('tipoimparticion')->nullable();
            $table->date('fechacreacion_actualizacion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
