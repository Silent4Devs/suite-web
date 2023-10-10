<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosMinutasAltaDireccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados_minutas_alta_direccion', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('minuta_id');
            $table->unsignedBigInteger('empleado_id');
            $table->timestamps();
        });
        Schema::table('empleados_minutas_alta_direccion', function (Blueprint $table) {
            $table->foreign('minuta_id')->references('id')->on('minutasaltadireccions');
            $table->foreign('empleado_id')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados_minutas_alta_direccion');
    }
}
