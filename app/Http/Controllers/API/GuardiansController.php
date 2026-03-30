<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Guardian;

class GuardiansController extends Controller
{
    public function index()
    {
        return Guardian::all();
    }
}
