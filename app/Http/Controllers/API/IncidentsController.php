<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Incident;
use App\Rescuer;
use DB;

class IncidentsController extends Controller
{
    public function index()
    {
        $incidents = Incident::with('guardian', 'rescuers')
            ->where('status', 'pending')
            ->latest('id')
            ->get();

        return $incidents;
    }

    public function store()
    {
        // placeholder for your create logic
    }

    /**
     * DISPATCH INCIDENT (MULTIPLE RESCUERS VERSION)
     */
  // public function dispatchIncident(Request $request, $id)
  //   {
  //       $incident = Incident::findOrFail($id);

  //       $rescuerIds = $request->input('rescuer_ids');

  //       if (!$rescuerIds || !is_array($rescuerIds)) {
  //           return response()->json([
  //               'message' => 'No rescuers selected'
  //           ], 422);
  //       }

  //       // update incident status
  //       $incident->status = 'dispatched';
  //       $incident->save();

  //       //  THIS IS THE IMPORTANT PART
  //       $incident->rescuers()->sync($rescuerIds);

  //       return response()->json([
  //           'message' => 'Dispatched successfully',
  //           'incident' => $incident->load('rescuers')
  //       ]);
  //   }



    public function dispatchIncident(Request $request, $id)
    {
        $request->validate([
            'rescuer_ids' => 'required|array',
            'rescuer_ids.*' => 'exists:rescuers,id'
        ]);

        $incident = Incident::findOrFail($id);

        DB::transaction(function () use ($incident, $request) {

            // 1. update incident status
            $incident->update([
                'status' => 'dispatched'
            ]);

            // 2. prepare pivot data
            $syncData = [];

            foreach ($request->rescuer_ids as $rescuerId) {
                $syncData[$rescuerId] = [
                    'status' => 'pending',
                    'assigned_at' => now()
                ];
            }

            // 3. assign rescuers
            $incident->rescuers()->sync($syncData);
        });

        return response()->json([
            'message' => 'Dispatched successfully',
            'incident' => $incident->fresh()->load('rescuers')
        ]);
    }
}