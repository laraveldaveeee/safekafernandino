<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Admin;
use App\Role;
class UsersController extends Controller
{
    public function index()
    {
        return User::with('admin')->get();
    }

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

    public function edit(User $user)
    {
         $user->load('admin');

          return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'address' => $user->admin->address ?? null,
            'mobile' => $user->admin->mobile ?? null,
            'birthdate' => $user->admin->birthdate ?? null,
        ]);

    }


    public function update(Request $request, User $user)
    {
        // Validate input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'mobile' => 'nullable',
            'address' => 'nullable',
            'birthdate' => 'nullable|date',
        ]);

        $role = Role::where('name', 'ADMINISTRATOR')->first();
        // Update Admin fields (assuming admin exists)
        if ($user->admin) {
            $user->admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'birthdate' => $request->birthdate,
            ]);
        }
        // Update User
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }
        $user->update($userData);
        $user->role()->associate($role)->save();
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user->load('admin')
        ]);
    } 

 
    public function show(User $user)
    {
        return $user;
    }

    public function destroy(User $user)
    {
        return $user->delete();
    }
}
