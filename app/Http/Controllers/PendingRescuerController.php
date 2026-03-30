<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rescuer;
class PendingRescuerController extends Controller
{
    public function index()
    {
        return view('rescuers-pending.index');
    }

    public function manage(Rescuer $rescuer)
    {
        return view('rescuers-pending.manage', compact('rescuer'));
    }
}
