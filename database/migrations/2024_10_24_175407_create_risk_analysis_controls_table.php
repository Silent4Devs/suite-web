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
        Schema::create('risk_analysis_controls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('control_id')->nullable();
            $table->boolean('applicability');
            $table->boolean('is_apply');
            $table->text('justification')->nullable();
            $table->string('file')->nullable();
            $table->foreign('control_id')->references('id')->on('gap_dos_catalogo_isos')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk_analysis_controls');
    }
};
