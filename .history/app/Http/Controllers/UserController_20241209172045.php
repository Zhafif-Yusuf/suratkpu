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
    return response()->json(User::all(['id', 'username']));
}

}
