<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkPerfilEmpleadoToPuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puestos', function (Blueprint $table) {
            $table->unsignedInteger('perfil_empleado_id')->nullable();
            $table->foreign('perfil_empleado_id')->references('id')->on('perfil_empleados')->onDelete('SET NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('puestos', function (Blueprint $table) {
            //
        });
    }
}
