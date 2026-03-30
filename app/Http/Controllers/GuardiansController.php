<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuardiansController extends Controller
{
    public function index()
    {
        return view('guardians.index');
    }
}
