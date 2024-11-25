<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratMasukTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat', 50); // Menyesuaikan dengan 'varchar(50)'
            $table->date('tanggal_surat'); // Menyesuaikan dengan 'date'
            $table->string('tujuan_surat', 100); // Menyesuaikan dengan 'varchar(100)'
            $table->string('perihal_surat', 150); // Menyesuaikan dengan 'varchar(150)'
            $table->binary('file'); // Menyesuaikan dengan 'longblob'
            $table->string('nama_file', 255); // Menyesuaikan dengan 'varchar(255)'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuk');
    }
}
