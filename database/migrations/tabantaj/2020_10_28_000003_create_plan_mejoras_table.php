<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanMejorasTable extends Migration
{
    public function up()
    {
        Schema::create('plan_mejoras', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('descripcion')->nullable();
            $table->date('fecha_compromiso')->nullable();
            $table->string('estatus')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
