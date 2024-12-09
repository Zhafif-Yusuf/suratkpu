<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk'; // Menambahkan properti $table untuk menunjuk tabel yang benar

    // Daftar kolom yang boleh diisi (fillable)
    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'tujuan_surat',
        'perihal_surat',
        'file',
        'nama_file',
        'user_id', // Menambahkan 'user_id' agar bisa diisi
    ];

    /**
     * Relasi dengan model User (One to Many).
     * SuratMasuk dimiliki oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class); // One SuratMasuk belongs to one User
    }
}
