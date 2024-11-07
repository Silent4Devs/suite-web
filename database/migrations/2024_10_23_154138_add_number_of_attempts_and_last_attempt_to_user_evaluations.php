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
        Schema::table('user_evaluations', function (Blueprint $table) {
            //
            $table->integer('number_of_attempts')->default(3);
            $table->timestamp('last_attempt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_evaluations', function (Blueprint $table) {
            //
            $table->dropColumn('number_of_attempts');
            $table->dropColumn('last_attempt');
        });
    }    
};
