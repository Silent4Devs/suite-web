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
        Schema::table('firma_centro_atencions', function (Blueprint $table) {

            $table->unsignedBigInteger('id_minutas')->nullable();
            $table->foreign('id_minutas')->references('id')->on('minutasaltadireccions')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
