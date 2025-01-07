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
        Schema::create('subscription_cancelations', function (Blueprint $table) {
            $table->id();

            $table->string('tenant_id')->nullable();
            $table->string('reason');

            $table->timestamps();

            $table->foreign('tenant_id')->references('id')->on('tenants')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_cancelations');
    }
};
