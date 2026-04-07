<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Rescuer;
class SignUpRescuersController extends Controller
{
   public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'type' => 'required',
        ]);

        $rescuer = Rescuer::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->type,
            'gender' => $request->gender,
            'contact' => $request->contact,
            'status' => 'pending',
            'is_active' => 0,
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rescuer_id' => $rescuer->id, 
            'status'    => 'pending'
        ]);

        return response()->json([
            'message' => 'Signup successful',
            'user' => $user,
            'rescuer' => $rescuer
        ]);
    }
}
