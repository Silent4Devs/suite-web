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
        Schema::create('action_events', function (Blueprint $table) {
            $table->id();
            $table->char('batch_id', 36);
            $table->integer('user_id')->index();
            $table->string('name');
            $table->string('actionable_type');
            $table->integer('actionable_id');
            $table->string('target_type');
            $table->integer('target_id');
            $table->string('model_type');
            $table->integer('model_id')->nullable();
            $table->text('fields');
            $table->string('status', 25)->default('running');
            $table->text('exception');
            $table->timestamps();

            $table->index(['actionable_type', 'actionable_id']);
            $table->index(['batch_id', 'model_type', 'model_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_events');
    }
};
