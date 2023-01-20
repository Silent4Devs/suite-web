<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRazonSocialColumnToOrganizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizacions', function (Blueprint $table) {
            // $table->string('razon_social')->nullable();
            // $table->string('rfc')->nullable();
            // $table->string('representante_legal')->nullable();
            // $table->date('fecha_constitucion')->nullable();
            // $table->integer('num_empleados')->nullable();
            // $table->string('tamano')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizacions', function (Blueprint $table) {
            //
        });
    }
}
