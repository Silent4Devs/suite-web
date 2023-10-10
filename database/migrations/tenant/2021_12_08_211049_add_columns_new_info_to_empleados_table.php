<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsNewInfoToEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->unsignedInteger('tipo_contrato_empleados_id')->nullable();
            $table->string('domicilio_personal')->nullable();
            $table->string('telefono_casa')->nullable();
            $table->string('correo_personal')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('NSS')->nullable();
            $table->string('CURP')->nullable();
            $table->string('RFC')->nullable();
            $table->string('lugar_nacimiento')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->unsignedInteger('entidad_crediticias_id')->nullable();
            $table->string('numero_credito')->nullable();
            $table->string('descuento')->nullable();
            $table->string('banco')->nullable();
            $table->string('cuenta_bancaria')->nullable();
            $table->string('clabe_interbancaria')->nullable();
            $table->string('centro_costos')->nullable();
            $table->float('salario_bruto')->nullable();
            $table->float('salario_diario')->nullable();
            $table->float('salario_diario_integrado')->nullable();
            $table->float('salario_base_mensual')->nullable();
            $table->string('pagadora_actual')->nullable();
            $table->string('periodicidad_nomina')->nullable();

            $table->foreign('tipo_contrato_empleados_id')->references('id')->on('tipo_contrato_empleados')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('entidad_crediticias_id')->references('id')->on('entidad_crediticias')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empleados', function (Blueprint $table) {
            //
        });
    }
}
