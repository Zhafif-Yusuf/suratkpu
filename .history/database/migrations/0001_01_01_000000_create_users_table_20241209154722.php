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
        // Tabel users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique(); // Username untuk login
            $table->string('password'); // Password
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });

        // Tabel sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // ID session
            $table->foreignId('user_id')->nullable()->index(); // Menyimpan referensi ke tabel users
            $table->string('ip_address', 45)->nullable(); // IP address
            $table->text('user_agent')->nullable(); // User agent untuk informasi browser
            $table->longText('payload'); // Data sesi
            $table->integer('last_activity')->index(); // Waktu aktivitas terakhir
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('users');
    }
};
