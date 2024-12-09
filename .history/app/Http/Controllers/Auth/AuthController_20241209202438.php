<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showMenu()
    {
        // Retrieve all usernames
        $users = User::select('username')->get();

        // Pass the $users variable to the view
        return view('suratkeluar.index', compact('users')); // Make sure this is your Blade view
    }
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login'); // View: resources/views/auth/login.blade.php
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string', // Using username, not email
            'password' => 'required|string',
        ]);

        // Attempt authentication with username and password
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->intended('/dashboard'); // Redirect to dashboard after login
        }

        // If authentication fails
        return back()->withErrors([
            'username' => 'Username or password is incorrect.',
        ]);
    }

    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register'); // View: resources/views/auth/register.blade.php
    }

    /**
     * Handle registration request.
     */
    public function register(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Password confirmation
        ]);

        // Create a new user
        $user = User::create([
            'username' => $validated['username'],
            'password' => bcrypt($validated['password']),
        ]);

        // Redirect to login with success message
        return redirect()->route('login')->with('success', 'Your account has been created!');
    }

    /**
     * Handle logout.
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/login'); // Redirect to login after logout
    }
}
