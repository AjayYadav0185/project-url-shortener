<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Invitation::class);
        $invitations = Invitation::whereNull('accepted_at')->get();
        return view('invitations.index', compact('invitations'));
    }

    public function create()
    {
        return view('invitations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:invitations,email|unique:users,email',
            'role' => 'required|in:admin,member,sales,manager'
        ]);

        $inviter = Auth::user();

        // PERMISSION RULES
        if ($inviter->role === 'superadmin' && $request->role === 'admin') {
            return back()->withErrors('SuperAdmin cannot invite Admin in a new company.');
        }

        if ($inviter->role === 'admin' && in_array($request->role, ['admin', 'member'])) {
            return back()->withErrors('Admin cannot invite Admin or Member.');
        }

        if (!in_array($inviter->role, ['superadmin', 'admin'])) {
            return back()->withErrors('You do not have permission to invite users.');
        }

        Invitation::create([
            'email' => $request->email,
            'role' => $request->role,
            'token' => Str::random(40)
        ]);

        return redirect()->route('invitations.index')
            ->with('success', 'Invitation created successfully.');
    }

    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)->firstOrFail();
        return view('invitations.accept', compact('invitation'));
    }

    public function complete(Request $request, $token)
    {
        $invitation = Invitation::where('token', $token)->firstOrFail();

        $request->validate([
            'name' => 'required',
            'password' => 'required|min:6'
        ]);

        User::create([
            'company_id' => 1,
            'email' => $invitation->email,
            'name' => $request->name,
            'role' => $invitation->role,
            'password' => Hash::make($request->password)
        ]);

        $invitation->update(['accepted_at' => now()]);

        return redirect('/login')->with('success', 'Account created. You can now login.');
    }
}
