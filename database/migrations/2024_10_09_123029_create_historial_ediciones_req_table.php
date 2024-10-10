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
        Schema::create('historial_ediciones_req', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisicion_id'); // ID del registro modificado
            $table->string('registro_tipo'); // Tipo de modelo (por ejemplo, App\Models\Registro)
            $table->unsignedBigInteger('id_empleado'); // ID del empleado que hizo el cambio
            $table->string('campo'); // Campo modificado
            $table->text('valor_anterior')->nullable(); // Valor anterior
            $table->text('valor_nuevo')->nullable(); // Valor nuevo
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('requisicion_id')->references('id')->on('requisiciones')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_empleado')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_ediciones_req');
    }
};
