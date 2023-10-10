<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanaccionCorrectivasTable extends Migration
{
    public function up()
    {
        Schema::create('planaccion_correctivas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('actividad');
            $table->date('fechacompromiso')->nullable();
            $table->string('estatus')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
