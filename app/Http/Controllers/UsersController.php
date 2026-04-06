<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Admin;
class UsersController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }
}
