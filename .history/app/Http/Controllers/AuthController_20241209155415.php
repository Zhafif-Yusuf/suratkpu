<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan form login.
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan view login ada di resources/views/auth/login.blade.php
    }

    /**
     * Proses login pengguna.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string', // Gunakan username bukan email
            'password' => 'required|string',
        ]);

        // Proses autentikasi menggunakan username dan password
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->intended('/dashboard'); // Redirect ke halaman dashboard atau halaman yang diinginkan
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    /**
     * Tampilkan form registrasi.
     */
    public function showRegistrationForm()
    {
        return view('auth.register'); // Pastikan view register ada di resources/views/auth/register.blade.php
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Konfirmasi password
        ]);

        // Simpan data pengguna
        $user = User::create([
            'username' => $validated['username'],
            'password' => bcrypt($validated['password']),
        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Akun Anda berhasil dibuat!');
    }
}
