<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
{
    $users = User::select('username')->get(); // Fetch only usernames
    return view('user-dropdown', compact('users')); // Pass data to view
}

}
