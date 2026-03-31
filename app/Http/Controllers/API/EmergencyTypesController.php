<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EmergencyType;

class EmergencyTypesController extends Controller
{
    public function index()
    {
        $emergencies = EmergencyType::all();

        return $emergencies;
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'name'  => 'required'
        ]);

        $emergency = EmergencyType::create([
            'name'  => request('name')
        ]);

        return $emergency;
    }

    public function destroy(EmergencyType $emergency)
    {
        return $emergency->delete();
    }
}
