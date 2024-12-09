<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function showMenu()
    {
        // Retrieve all usernames
        $users = User::select('username')->get();

        // Pass the $users variable to the view
        return view('', compact('users')); // Replace 'your-view-file' with your Blade filename (without .blade.php)
    }
}
