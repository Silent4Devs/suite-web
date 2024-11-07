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
        Schema::table('auditoria_internas', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('creador_auditoria_id')->nullable();

            $table->foreign('creador_auditoria_id')
                ->references('id')
                ->on('empleados')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('auditoria_internas', function (Blueprint $table) {
            //
            $table->dropForeign('creador_auditoria_id');

            // Add back the old foreign key constraint referencing the old table
            $table->foreign('creador_auditoria_id')
                ->references('id')
                ->on('empleados')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }
};
