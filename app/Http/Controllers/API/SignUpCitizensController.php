<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Guardian;
use App\User;
class SignUpCitizensController extends Controller
{
    // public function signup(Request $request)
    // {
    //        $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6',
    //         'gender' => 'nullable',
    //         'mobile' => 'nullable',
    //     ]);

    //     $guardian = Guardian::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'gender' => $request->gender,
    //         'mobile' => $request->mobile,
    //         'status' => 'pending',
    //     ]);

    //     $user = User::create([
    //         'role_id'   => 5,
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password),
    //         'guardian_id' => $guardian->id, 
    //         'status' => 'pending'
    //     ]);

    //     return response()->json([
    //         'message' => 'Signup successful',
    //         'user' => $user,
    //         'guardian' => $guardian
    //     ]);
    // }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',

            'gender' => 'nullable',
            'mobile' => 'nullable',
            'birthdate' => 'nullable|date',
            'address' => 'nullable',

            // file validation
            'is_id_verified' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'gesture_data' => 'nullable|file|max:2048',
            'medical_info' => 'nullable|file|max:2048',
        ]);

        // CREATE GUARDIAN FIRST
        // $guardian = new Guardian();
        // $guardian->name = $request->name;
        // $guardian->email = $request->email;
        // $guardian->gender = $request->gender;
        // $guardian->mobile = $request->mobile;
        // $guardian->birthdate = $request->birthdate;
        // $guardian->address = $request->address;
        // $guardian->status = 'pending';

        $guardian = Guardian::create([
            'name'  => $request->name,
            'email'  => $request->email,
            'gender'  => $request->gender,
            'mobile'  => $request->mobile,
            'birthdate'  => $request->birthdate,
            'address'  => $request->address,
            'status'  => 'pending'
        ]);


        // FILE UPLOADS
        if ($request->hasFile('is_id_verified')) {
            $guardian->is_id_verified = $request->file('is_id_verified')->store('uploads/ids', 'public');
        }
        if ($request->hasFile('gesture_data')) {
            $guardian->gesture_data = $request->file('gesture_data')->store('uploads/gesture', 'public');
        }

        if ($request->hasFile('medical_info')) {
            $guardian->medical_info = $request->file('medical_info')->store('uploads/medical', 'public');
        }
        $guardian->save();
        //CREATE USER
        $user = User::create([
            'role_id' => 5,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'guardian_id' => $guardian->id,
            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Signup successful',
            'user' => $user,
            'guardian' => $guardian
        ]);
    }
}
