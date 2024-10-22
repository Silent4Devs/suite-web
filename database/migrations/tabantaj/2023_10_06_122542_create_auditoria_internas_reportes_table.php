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
        Schema::create('auditoria_internas_reportes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_auditoria');
            $table->unsignedInteger('empleado_id');
            $table->unsignedInteger('lider_id');
            $table->longText('comentarios')->nullable();
            $table->string('estado')->nullable();
            $table->string('firma_empleado')->nullable();
            $table->string('firma_lider')->nullable();
            $table->timestamps();
            $table->foreign('id_auditoria')->references('id')->on('auditoria_internas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditoria_internas_reportes');
    }
};
