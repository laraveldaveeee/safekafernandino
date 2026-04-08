<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class CitizensController extends Controller
{
    public function pending()
    {
        return view('citizens-pending.pending');
    }

    public function manage(User $user)
    {
        return view('citizens-pending.manage', compact('user'));
    }
}
