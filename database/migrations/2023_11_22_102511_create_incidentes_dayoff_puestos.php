<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incidentes_dayoff_puestos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('incidente_id')->nullable();
            $table->unsignedBigInteger('puesto_id')->nullable();
            $table->foreign('incidente_id')->references('id')->on('incidentes_dayoff')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('puesto_id')->references('id')->on('puestos')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidentes_dayoff_puestos');
    }
};
