<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Guardian;

class GuardiansController extends Controller
{
    public function index()
    {
        return Guardian::all();
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'name'  => 'required',
            'gender'  => 'required',
            'mobile'  => 'required',
            'birthdate'  => 'required',
            'address'  => 'required',
            'is_id_verified'  => 'required',
            'gesture_data'  => 'required',
            'medical_info'  => 'required',
        ]);
        $guardian = Guardian::create([
                'name'  => $request->name,
                'email'  => $request->email,
                'type'  => $request->type,
                'gender'  => $request->gender,
                'mobile'  => $request->mobile,
                'birthdate'  => $request->birthdate,
                'address'  => $request->address,
                'is_id_verified'  => $request->is_id_verified,
                'gesture_data'  => $request->gesture_data,
                'medical_info'  => $request->medical_info,
                'status'  => 'pending',
        ]);

        return $guardian;
    }
    
}
