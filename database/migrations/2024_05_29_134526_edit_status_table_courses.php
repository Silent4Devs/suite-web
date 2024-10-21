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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('status')->default('1')->change();
            $table->dropUnique('courses_status_check');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
