<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnDescriptionToComunicacionSgisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comunicacion_sgis', function (Blueprint $table) {
            $table->longText('descripcion')->change();
            $table->string('habilitar')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comunicacion_sgis', function (Blueprint $table) {
            //
        });
    }
}
