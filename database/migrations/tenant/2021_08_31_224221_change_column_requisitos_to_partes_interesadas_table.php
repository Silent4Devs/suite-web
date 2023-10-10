<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnRequisitosToPartesInteresadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partes_interesadas', function (Blueprint $table) {
            $table->string('clausala')->change();
            $table->longText('requisitos')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partes_interesadas', function (Blueprint $table) {
            //
        });
    }
}
