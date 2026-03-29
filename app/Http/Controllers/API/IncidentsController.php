<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Incident;
class IncidentsController extends Controller
{
    public function index()
    {
        $incidents = Incident::all();
        return $incidents;
    }

    public function store()
    {
        // $incidents = Incident::create([

        // ]);
    }
}
