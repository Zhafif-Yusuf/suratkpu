<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang dapat diisi (mass assignable).
     */
    protected $fillable = [
        'name',
        'username', // Tambahkan username
        'email',
        'password',
        'role', // Tambahkan role
    ];

    /**
     * Kolom yang harus disembunyikan dari array atau JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Tipe data asli dari kolom tertentu.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
