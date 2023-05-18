<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAddQuejadosCamposToQuejas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quejas', function (Blueprint $table) {
            $table->longText('area_quejado')->nullable()->change();
            $table->longText('externo_quejado')->nullable()->change();
            $table->longText('proceso_quejado')->nullable()->change();
            $table->longText('colaborador_quejado')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quejas', function (Blueprint $table) {
            $table->string('area_quejado')->nullable()->change();
            $table->string('proceso_quejado')->nullable()->change();
            $table->string('externo_quejado')->nullable()->change();
            $table->string('colaborador_quejado')->nullable()->change();
        });
    }
}
