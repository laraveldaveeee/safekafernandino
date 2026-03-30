<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rescuer;
class PendingRescuerController extends Controller
{
    public function index()
    {
        return Rescuer::where('status', 'pending')->get();
    }

    public function manage(Rescuer $rescuer)
    {
        return $rescuer;
    }

    public function approve(Request $request, Rescuer $rescuer)
    {
       
        $rescuer->update([

            'status'    => 'approved'
        ]);

        return response()->json($rescuer);
    }

    public function decline(Request $request, Rescuer $rescuer)
    {
        $rescuer->update([
            'status'    => 'declined'
        ]);

        return $rescuer;
    }
}
