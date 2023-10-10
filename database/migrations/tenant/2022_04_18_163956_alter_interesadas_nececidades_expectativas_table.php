<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterInteresadasNececidadesExpectativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interesadas_nececidades_expectativas', function (Blueprint $table) {
            $table->longText('necesidades')->nullable()->change();
            $table->longText('expectativas')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interesadas_nececidades_expectativas', function (Blueprint $table) {
            //
        });
    }
}
