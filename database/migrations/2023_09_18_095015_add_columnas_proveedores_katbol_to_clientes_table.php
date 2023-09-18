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
        Schema::table('timesheet_clientes', function (Blueprint $table) {
            //
            $table->longText('objeto_descripcion')->nullable();
            $table->longText('cobertura')->nullable();
            $table->unsignedBigInteger('id_fiscale')->nullable();
            $table->foreign('id_fiscale')->references('id')->on('fiscales')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('timesheet_clientes', function (Blueprint $table) {
            //
        });
    }
};
