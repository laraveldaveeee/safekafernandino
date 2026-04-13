<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function guardian()
    {
        return view('signup.sign-up');
    }

    public function rescuer()
    {
        return view('signup.rescuer-sign-up');
    }
}
