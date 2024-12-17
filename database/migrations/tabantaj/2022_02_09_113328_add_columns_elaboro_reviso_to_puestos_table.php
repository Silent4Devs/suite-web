<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsElaboroRevisoToPuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puestos', function (Blueprint $table) {
            $table->integer('elaboro_id')->nullable();
            $table->integer('reviso_id')->nullable();
            $table->integer('autoriza_id')->nullable();
            $table->integer('reporta_puesto_id')->nullable();
            $table->foreign('autoriza_id')->references('id')->on('empleados')->onDelete('SET NULL')->onUpdate('cascade');
            $table->foreign('reviso_id')->references('id')->on('empleados')->onDelete('SET NULL')->onUpdate('cascade');
            $table->foreign('elaboro_id')->references('id')->on('empleados')->onDelete('SET NULL')->onUpdate('cascade');
            $table->foreign('reporta_puesto_id')->references('id')->on('puestos')->onDelete('SET NULL')->onUpdate('cascade');
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
