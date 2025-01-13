<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNombredevpIdActivosInformacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activos_informacion', function (Blueprint $table) {
            $table->integer('vp_id')->nullable();
            $table->foreign('vp_id')->references('id')->on('grupos')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('name_direccion_id')->nullable();
            $table->foreign('name_direccion_id')->references('id')->on('areas')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('nombredevp_id')->nullable();
            $table->foreign('nombredevp_id')->references('id')->on('grupos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
