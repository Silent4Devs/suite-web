<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstatusPlanTrabajosTable extends Migration
{
    public function up()
    {
        Schema::create('estatus_plan_trabajos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('estado')->nullable();
            $table->longText('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
