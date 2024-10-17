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
        Schema::table('ev360_objetivo_empleados', function (Blueprint $table) {
            //
            $table->boolean('papelera')->default(false);
            $table->boolean('ev360')->default(true);
            $table->boolean('mensual')->default(false);
            $table->boolean('bimestral')->default(false);
            $table->boolean('trimestral')->default(false);
            $table->boolean('semestral')->default(false);
            $table->boolean('anualmente')->default(false);
            $table->boolean('abierta')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ev360_objetivo_empleados', function (Blueprint $table) {
            //
            $table->dropColumn('papelera');
            $table->dropColumn('ev360');
            $table->dropColumn('mensual');
            $table->dropColumn('bimestral');
            $table->dropColumn('trimestral');
            $table->dropColumn('semestral');
            $table->dropColumn('anualmente');
            $table->dropColumn('abierta');
        });
    }
};
