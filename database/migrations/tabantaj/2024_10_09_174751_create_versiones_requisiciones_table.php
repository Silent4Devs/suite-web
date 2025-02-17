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
        Schema::create('versiones_requisicion', function (Blueprint $table) {
            $table->id();
            $table->integer('requisicion_id');
            $table->integer('version')->default(1);
            $table->timestamp('last_updated_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Relaciones
            $table->foreign('requisicion_id')->references('id')->on('requisiciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisiciones_versiones');
    }
};
