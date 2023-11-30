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
        Schema::create('secciones_template_analisisde_brechas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('template_id');
            $table->integer('numero_seccion');
            $table->longText('descripcion');
            $table->unsignedDecimal('porcentaje_seccion');
            $table->foreign('template_id')->references('id')->on('template_analisisde_brechas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secciones_template_analisisde_brechas');
    }
};
