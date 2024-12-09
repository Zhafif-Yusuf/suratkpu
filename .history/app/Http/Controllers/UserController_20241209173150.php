<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the list of usernames for the dropdown.
     */
    public function showUsernames()
    {
        $users = User::all(); // Get all users from the database
        return response()->json($users); // Return the data as a JSON response
    }
}
