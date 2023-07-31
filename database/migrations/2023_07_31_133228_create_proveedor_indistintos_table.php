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
        Schema::create('proveedor_indistintos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisicion_id')->nullable();
            // $table->foreign('requisicion_id')->references('id')->on('requsiciones')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('proveedor_indistinto_id')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedor_indistintos');
    }
};
