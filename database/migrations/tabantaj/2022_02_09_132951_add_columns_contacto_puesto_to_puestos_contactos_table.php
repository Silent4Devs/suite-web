<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsContactoPuestoToPuestosContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puestos_contactos', function (Blueprint $table) {
            $table->unsignedInteger('contacto_puesto_id')->nullable();
            $table->foreign('contacto_puesto_id')->references('id')->on('puestos')->onDelete('SET NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('puestos_contactos', function (Blueprint $table) {
            //
        });
    }
}
