<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsTemaReunionToMinutasaltadireccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('minutasaltadireccions', function (Blueprint $table) {
            $table->time('hora_inicio')->nullable();
            $table->time('hora_termino')->nullable();
            $table->string('tema_reunion')->nullable();
            $table->longText('tema_tratado')->nullable();
            $table->string('documento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('minutasaltadireccions', function (Blueprint $table) {
            //
        });
    }
}
