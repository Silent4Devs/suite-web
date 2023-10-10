<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToGapLogroUnoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gap_logro_uno', function (Blueprint $table) {
            $table->unsignedInteger('analisis_brechas_id')->nullable();
            $table->foreign('analisis_brechas_id')->references('id')->on('analisis_brechas')->onDelete('SET NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gap_logro_uno', function (Blueprint $table) {
            //
        });
    }
}
