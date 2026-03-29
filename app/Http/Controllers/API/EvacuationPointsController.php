<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EvacuationPoint;
class EvacuationPointsController extends Controller
{
    public function index()
    {
        $evacuationPoints = EvacuationPoint::all();
        return $evacuationPoints;
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'name'  => 'required',
            'latitude'  => 'required',
            'longitude'  => 'required',
            'status'  => 'required',
        ]);
        $evacuationPoint = EvacuationPoint::create([
            'name'  => request('name'),
            'latitude'  => request('latitude'),
            'longitude'  => request('longitude'),
            'status'  => request('status'),
        ]);

        return $evacuationPoint;
    }


    public function show(EvacuationPoint $evacuationPoint)
    {
        return response()->json([
            'success' => true,
            'data' => $evacuationPoint
        ]);
    }
}
