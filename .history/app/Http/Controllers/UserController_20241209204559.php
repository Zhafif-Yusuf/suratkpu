<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Fetch all users
        $users = User::all();

        // Pass users to the view
        return view('users.index', compact('users'));
    }
}

