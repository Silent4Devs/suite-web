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
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('db_name')->after('name')->nullable();
            $table->string('db_host')->default('127.0.0.1')->after('db_name');
            $table->string('db_username')->after('db_host')->nullable();
            $table->string('db_password')->after('db_username')->nullable();
            $table->integer('migrate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn('db_name');
            $table->dropColumn('db_host');
            $table->dropColumn('db_username');
            $table->dropColumn('db_password');
            $table->dropColumn('migrate');
        });
    }
};
