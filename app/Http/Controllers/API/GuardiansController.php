<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Guardian;
use App\User;

class GuardiansController extends Controller
{

    public function index()
    {
        $user = User::with('role', 'guardian')
                    ->where('status', 'approved')
                    ->whereNotIn('role_id', [1,2,3,4])
                    ->get();

        return $user;
    }

    public function profile(User $user)
    {
        $user->load('guardian');
        return $user;
    }

    public function pending()
    {
        $user = User::with('role', 'guardian')
                    ->where('status', 'pending')
                    ->whereNotIn('role_id', [1,2,3,4])
                    ->get();

        return $user;
    }

    public function manage(User $user)
    {
        return $user->load('guardian');
    }

    public function approve(User $user, Request $request)
    { 
        $user->update([
            'status' => 'approved',
        ]);

        $user->guardian()->update([
            'status'    => 'approved'
        ]);

        return response()->json([
            'message' => 'Role assigned and user approved successfully',
            'user' => $user->load('guardian')
        ]);
    }

   
    public function decline(User $user)
    {
        $user->guardian()->update([
            'status' => 'declined',
        ]);

        $user->update([
            'status' => 'declined',
        ]);

        return response()->json(['message' => 'Declined']);
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
