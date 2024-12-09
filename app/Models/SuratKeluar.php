<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar';

    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'tujuan_surat',
        'perihal_surat',
        'file',
        'nama_file',
        'user_id',  // user_id to track the creator
    ];
    public function user()
    {
        return $this->belongsTo(User::class); // One SuratKeluar belongs to one User
    }

    // Accessor to get the full URL of the file
    public function getFileUrlAttribute()
    {
        return $this->file ? Storage::url($this->file) : null;
    }

    // Mutator to store the file and set the file path and name
    public function setFileAttribute($value)
    {
        if (is_file($value)) {
            // Handle the file upload, save the file and return its path
            $this->attributes['file'] = $value->storeAs('suratkeluar_files', $value->getClientOriginalName(), 'public');
            $this->attributes['nama_file'] = $value->getClientOriginalName();
        }
    }

    // Accessor to retrieve the file name
    public function getNamaFileAttribute($value)
    {
        return $value ? $value : 'No file available';
    }

    // Optional: Mutator for the date format (if needed)
    public function getTanggalSuratAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    // Optional: Accessor to format 'nomor_surat' if necessary
    public function getNomorSuratAttribute($value)
    {
        return strtoupper($value);
    }

    // Automatically set the user_id when creating SuratKeluar
    protected static function booted()
    {
        static::creating(function ($suratKeluar) {
            // Automatically assign the authenticated user ID to the user_id field
            if (auth()->check()) {
                $suratKeluar->user_id = auth()->id();
            }
        });
    }
}
