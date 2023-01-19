<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanBaseActividadesTable extends Migration
{
    public function up()
    {
        Schema::create('plan_base_actividades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('actividad')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->date('compromiso')->nullable();
            $table->date('real')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
