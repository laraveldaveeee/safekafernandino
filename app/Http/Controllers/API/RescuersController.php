<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rescuer;
class RescuersController extends Controller
{
    public function index()
    {
        $rescuers = Rescuer::with('emergency')->where('status', 'approved')->get();

        return $rescuers;
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'name'  => 'required',
            'email'  => 'required',
            'type'  => 'required',
            'gender'  => 'required',
            'mobile'  => 'required',
            'birthdate'  => 'required',
            'station_location'  => 'required',
            'latitude'  => 'required',
            'longitude'  => 'required',
            'is_id_verified'  => 'required',
        ]);
        $rescuer = Rescuer::create([
            'name'  => request('name'),
            'email'  => request('email'),
            'type'  => request('type'),
            'gender'  => request('gender'),
            'mobile'  => request('mobile'),
            'birthdate'  => request('birthdate'),
            'station_location'  => request('station_location'),
            'latitude'  => request('latitude'),
            'longitude'  => request('longitude'),
            'is_active'  => 1,
            'is_id_verified'  => request('is_id_verified'),
            'valid_id_path'  => request('valid_id_path'),
            'status'  => 'Pending',
        ]);
    }

    public function show(Rescuer $rescuer)
    {
        return $rescuer;
    }
}
    