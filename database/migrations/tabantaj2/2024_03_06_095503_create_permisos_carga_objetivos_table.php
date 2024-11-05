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
        Schema::create('permisos_carga_objetivos', function (Blueprint $table) {
            $table->id();
            $table->text('perfil');
            $table->boolean('permisos_asignacion')->default(false);
            $table->boolean('permiso_objetivos')->default(false);
            $table->boolean('permiso_escala')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permisos_carga_objetivos');
    }
};
