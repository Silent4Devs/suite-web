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
        Schema::table('ev360_objetivos', function (Blueprint $table) {
            //
            $table->text('meta')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ev360_objetivos', function (Blueprint $table) {
            //
            // $table->text('meta')->nullable(false)->change();
        });
    }
};
