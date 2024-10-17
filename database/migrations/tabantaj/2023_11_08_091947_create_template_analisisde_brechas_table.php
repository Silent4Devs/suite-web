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
        Schema::create('template_analisisde_brechas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_template');
            $table->unsignedBigInteger('norma_id');
            $table->longText('descripcion');
            $table->integer('no_secciones');
            $table->foreign('norma_id')->references('id')->on('normas')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_analisisde_brechas');
    }
};
