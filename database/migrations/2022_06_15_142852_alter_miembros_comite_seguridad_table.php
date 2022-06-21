<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMiembrosComiteSeguridadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('miembros_comite_seguridad', function (Blueprint $table) {
            $table->unsignedBigInteger('comite_id')->nullable();
            $table->foreign('comite_id')->references('id')->on('comite_seguridad')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('miembros_comite_seguridad', function (Blueprint $table) {
            //
        });
    }
}
