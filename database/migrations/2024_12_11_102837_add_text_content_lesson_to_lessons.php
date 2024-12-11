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
        Schema::table('lessons', function (Blueprint $table) {
            //
            $table->string('url')->nullable()->change();
            $table->string('iframe')->nullable()->change();
            $table->longText('text_content_lesson')->nullable()->default('text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            //
            $table->string('url')->nullable(false)->change();
            $table->string('iframe')->nullable(false)->change();
            $table->dropColumn('text_content_lesson');
        });
    }
};
