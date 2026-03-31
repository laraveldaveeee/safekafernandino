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

    // public function dispatch($id)
    // {
    //     $incident = Incident::findOrFail($id);
    //     $incident->status = 'Dispatched';
    //     $incident->save();

    //     return response()->json(['message' => 'Dispatched successfully']);
    // }

    public function dispatch($id)
    {
        $incident = Incident::findOrFail($id);

        $incident->status = 'Dispatched';
        $incident->save();

        if ($incident->rescuer && $incident->rescuer->contact) {

            \Log::info('RESCUER DEBUG', [
                'rescuer_id' => $incident->rescuer->id,
                'contact' => $incident->rescuer->contact
            ]);

            $incident->rescuer->notify(
                new \App\Notifications\IncidentDispatched($incident)
            );

        } else {
            \Log::error('Rescuer or contact missing', [
                'incident_id' => $incident->id
            ]);
        }

        return response()->json([
            'message' => 'Incident dispatched successfully'
        ]);
    }

}
