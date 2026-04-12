<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rescuer;
use App\User;
use App\Role;
class PendingRescuerController extends Controller
{
    public function index()
    {
        return User::with('rescuer', 'role')->where('status', 'pending')->get();
    }

    public function manage(User $user)
    {
        return response()->json([
            'user' => $user->load('rescuer', 'role'),
            'roles' => Role::whereNotIn('id', [1, 5])->get()
        ]);
    }
   public function approve(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update([
            'role_id' => $request->role_id,
            'status' => 'approved',
        ]);

        $user->rescuer()->update([
            'status'    => 'approved'
        ]);

        return response()->json([
            'message' => 'Role assigned and user approved successfully',
            'user' => $user->load('role', 'rescuer')
        ]);
    }

    public function decline(User $user)
    {
        $user->rescuer()->update([
            'status' => 'declined',
            'is_active' => 0
        ]);

        $user->update([
            'status'    => 'declined'
        ]);

        return response()->json(['message' => 'Declined']);
    }
}
