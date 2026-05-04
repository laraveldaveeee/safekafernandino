<?php

namespace App\Http\Controllers\API; 
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Rescuer;
use App\EmergencyType;
class SignUpRescuersController extends Controller
{

   public function index()
   {
      return EmergencyType::all();
   }

  public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'emergency_id' => 'required|exists:emergency_types,id',
            'is_id_verified' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        // FILE UPLOAD
        $filePath = null;
        if ($request->hasFile('is_id_verified')) {
            $filePath = $request->file('is_id_verified')->store('ids', 'public');
        }


        $emergency = EmergencyType::find($request->emergency_id);


        // CREATE RESCUER
        $rescuer = Rescuer::create([
            'name' => $request->name,
            'email' => $request->email,
            'emergency_id' => $request->emergency_id, 
            'type' => $emergency->name, 
 
            'gender' => $request->gender,
            'contact' => $request->contact,
            'station_location' => $request->station_location,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'is_id_verified' => $filePath,
            'status' => 'pending',
            'is_active' => 0,
        ]);

        // CREATE USER
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rescuer_id' => $rescuer->id,
            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Signup successful',
            'user' => $user,
            'rescuer' => $rescuer
        ]);
    }
}
