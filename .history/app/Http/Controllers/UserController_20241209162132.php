<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the list of users.
     */
    public function index()
    {
        $users = User::all(); // Retrieve all users from the database
        return view('users.index', compact('users')); // Pass users to the view
    }
}
