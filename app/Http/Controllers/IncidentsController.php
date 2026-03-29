<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncidentsController extends Controller
{
    public function index()
    {
        return view('incidents.index');
    }
}
