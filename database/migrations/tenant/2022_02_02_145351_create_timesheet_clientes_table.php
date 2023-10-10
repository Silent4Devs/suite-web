<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesheetClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheet_clientes', function (Blueprint $table) {
            $table->id();

            $table->string('razon_social');
            $table->string('nombre')->nullable();
            $table->string('rfc')->nullable();

            $table->string('calle')->nullable();
            $table->string('colonia')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('telefono')->nullable();
            $table->string('pagina_web')->nullable();

            $table->string('nombre_contacto')->nullable();
            $table->string('puesto_contacto')->nullable();
            $table->string('correo_contacto')->nullable();
            $table->string('celular_contacto')->nullable();

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
        Schema::dropIfExists('timesheet_clientes');
    }
}
