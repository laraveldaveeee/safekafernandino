<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rescuer;
use App\Incident;
class IncidentRescuersController extends Controller
{
  public function pending()
    {
        $data = \DB::table('incident_rescuer')
            ->join('incidents', 'incident_rescuer.incident_id', '=', 'incidents.id')
            ->select(
                'incidents.id',
                'incidents.type',
                'incidents.status',
                'incident_rescuer.status as my_status',
                'incident_rescuer.assigned_at'
            )
            ->where('incident_rescuer.status', 'pending')
            ->get();

        return response()->json($data);
    }
}
