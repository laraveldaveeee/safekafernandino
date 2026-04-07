<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignUpRescuersController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $role = Role::where('name', 'ADMINISTRATOR')->first();

        $admin = Admin::create([
            'name'  => $request->name,
            'email'  => $request->email,
            'mobile'  => $request->mobile,
            'address'  => $request->address,
            'birthdate'  => $request->birthdate,
        ]);

        $user = User::create([
            'admin_id'  => $admin->id,
            'name' => $admin->name,
            'email' => $admin->email,
            'password' => bcrypt($request->password),
            'status'    => 'confirmed'
        ]);
     $user->role()->associate($role)->save();

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }
}
