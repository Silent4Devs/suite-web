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
        Schema::table('catalogue_training', function (Blueprint $table) {
            $table->string('mark')->nullable()->change();
            $table->string('manufacturer')->nullable()->change();
            $table->string('norma')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('catalogue_training', function (Blueprint $table) {
            //
        });
    }
};
