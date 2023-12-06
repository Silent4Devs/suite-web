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
        Schema::create('incidentes_vacaciones_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('incidente_id')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('incidente_id')->references('id')->on('incidentes_vacaciones')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidentes_vacaciones_areas');
    }
};
