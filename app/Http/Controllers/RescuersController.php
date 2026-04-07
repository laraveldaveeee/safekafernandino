<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rescuer;
use App\User;
class RescuersController extends Controller
{
    public function index()
    {
        return view('rescuers.index');
    }

    public function show(User $user)
    {
        return view('rescuers.show', compact('user'));
    }
}
