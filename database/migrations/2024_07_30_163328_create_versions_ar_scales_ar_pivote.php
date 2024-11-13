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
        Schema::create('versions_ar_scales_ar_pivote', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('period_id')->nullable();
            $table->float('valor_min', 32, 2);
            $table->float('valor_max', 32, 2);
            $table->foreign('period_id')->references('id')->on('period_risk_analysis')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('versions_ar_scales_ar_pivote');
    }
};
