<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablalogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_dml');
            $table->string('tabla');
            $table->longText('old_values')->nullable();
            $table->string('usuario')->nullable();
            $table->timestamp('fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tablalogs');
    }
};
