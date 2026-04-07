<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rescuer;
use App\Incident;
class IncidentRescuersController extends Controller
{
    public function pending(Request $request)
    {
        $request->validate([
            'rescuer_id' => 'required|exists:rescuers,id'
        ]);

        $rescuer = Rescuer::findOrFail($request->rescuer_id);

        $incidents = $rescuer->incidents()
            ->wherePivot('status', 'pending')
            ->with('rescuers') // optional
            ->latest()
            ->get();

        return response()->json($incidents);
    }
}
