<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rescuer;
class RescuersController extends Controller
{
    public function index()
    {
        $rescuers = Rescuer::where('status', 'approved')->get();

        return $rescuers;
    }

    public function show(Rescuer $rescuer)
    {
        return $rescuer;
    }
}
