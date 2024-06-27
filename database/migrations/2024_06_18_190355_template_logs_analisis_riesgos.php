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
        Schema::create('template_logs_analisis_riesgos', function (Blueprint $table) {
            $table->id();
            $table->string('step');
            $table->string('action');
            $table->unsignedBigInteger('empleado_id')->nullable();
            $table->unsignedBigInteger('template_id')->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->foreign('template_id')->references('id')->on('template_analisis_riesgos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_logs_analisis_riesgos');
    }
};
