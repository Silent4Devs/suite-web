<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardIndicadoresSgiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard_indicadores_sgi', function (Blueprint $table) {
            $table->id();
            $table->integer('porcentaje_cumplimiento')->default(60);
            $table->integer('alta')->nullable();
            $table->integer('media')->nullable();
            $table->integer('baja')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dashboard_indicadores_sgi');
    }
}
