<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmergencyTypesController extends Controller
{
    public function index()
    {
        return view('emergency-types.index');
    }
}
