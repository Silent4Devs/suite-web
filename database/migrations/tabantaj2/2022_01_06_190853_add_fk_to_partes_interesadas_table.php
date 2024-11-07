<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToPartesInteresadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partes_interesadas', function (Blueprint $table) {
            $table->unsignedInteger('norma_id')->nullable();
            $table->foreign('norma_id')->references('id')->on('normas')->onDelete('SET NULL')->onUpdate('cascade');
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
