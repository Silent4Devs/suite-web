<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanelInicioRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panel_inicio_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('nombre')->nullable()->default(1);
            $table->boolean('area')->nullable()->default(1);
            $table->boolean('puesto')->nullable()->default(1);
            $table->boolean('jefe_inmediato')->nullable()->default(1);
            $table->boolean('n_empleado')->nullable()->default(0);
            $table->boolean('perfil')->nullable()->default(0);
            $table->boolean('fecha_ingreso')->nullable()->default(0);
            $table->boolean('genero')->nullable()->default(0);
            $table->boolean('estatus')->nullable()->default(0);
            $table->boolean('email')->nullable()->default(0);
            $table->boolean('movil')->nullable()->default(0);
            $table->boolean('telefono')->nullable()->default(0);
            $table->boolean('sede')->nullable()->default(0);
            $table->boolean('direccion')->nullable()->default(0);
            $table->boolean('cumpleaños')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('panel_inicio_rules');
    }
}
