<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cedula_cumplimiento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contrato_id')->nullable();
            $table->string('elaboro')->nullable()->default('');
            $table->string('reviso')->nullable()->default('');
            $table->string('autorizo')->nullable()->default('');
            $table->string('cumple', 10)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('contrato_id')->references('id')->on('contratos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cedula_cumplimiento', function (Blueprint $table) {
            //
            $table->dropForeign(['contrato_id']);
        });
        Schema::dropIfExists('cedula_cumplimiento');
    }
};
