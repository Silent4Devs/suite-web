<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index('id');
            $table->index('n_empleado');
            $table->index('email');
            $table->index('empleado_id');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Eliminar índices
            $table->dropIndex(['email']);
            $table->dropUnique(['id']);
            $table->dropIndex(['n_empleado']);
            $table->dropIndex(['empleado_id']);
        });
    }
};
