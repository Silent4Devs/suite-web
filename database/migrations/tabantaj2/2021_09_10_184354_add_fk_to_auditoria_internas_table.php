<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToAuditoriaInternasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auditoria_internas', function (Blueprint $table) {
            $table->unsignedBigInteger('lider_id');
            $table->foreign('lider_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auditoria_internas', function (Blueprint $table) {
            //
        });
    }
}
