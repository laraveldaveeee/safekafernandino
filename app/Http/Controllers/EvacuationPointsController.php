<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\EvacuationPoint;
class EvacuationPointsController extends Controller
{
    public function index()
    {
        return view('evacuation-points.index');
    }

    public function show(EvacuationPoint $evacuationPoint)
    {
        return view('evacuation-points.show', compact('evacuationPoint'));
    }
}
