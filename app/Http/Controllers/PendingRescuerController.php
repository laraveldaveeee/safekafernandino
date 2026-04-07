<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rescuer;
use App\User;
class PendingRescuerController extends Controller
{
    public function index()
    {
        return view('rescuers-pending.index');
    }

    public function manage(User $user)
    {
        return view('rescuers-pending.manage', compact('user'));
    }
}
