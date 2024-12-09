<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Fetch usernames
        $users = User::select('username')->get();

        // Pass to the view
        return view('user-dropdown', compact('users'));
    }
}
