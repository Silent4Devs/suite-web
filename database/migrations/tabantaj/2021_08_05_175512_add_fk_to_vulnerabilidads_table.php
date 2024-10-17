<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToVulnerabilidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vulnerabilidads', function (Blueprint $table) {
            $table->foreign('id_amenaza')->references('id')->on('amenazas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vulnerabilidads', function (Blueprint $table) {
            //
        });
    }
}
