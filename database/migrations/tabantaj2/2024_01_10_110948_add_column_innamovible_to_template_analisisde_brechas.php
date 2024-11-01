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
        Schema::table('template_analisisde_brechas', function (Blueprint $table) {
            //
            $table->boolean('innamovible')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('template_analisisde_brechas', function (Blueprint $table) {
            //
            $table->dropColumn('innamovible');
        });
    }
};
