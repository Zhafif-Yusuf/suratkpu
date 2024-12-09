<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Fetch usernames from the database
        $users = User::select('username')->get();

        // Pass the usernames to the view
        return view('user-dropdown', compact('users'));
    }
}
