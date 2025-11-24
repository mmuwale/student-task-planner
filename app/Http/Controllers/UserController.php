<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Check if user is admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            $users = User::with(['courses', 'tasks', 'studyGroups'])->get();
            return view('admin.users.index', compact('users'));
        }
        
        // Redirect non-admin users to dashboard
        return redirect()->route('dashboard');
    }

    public function create()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('admin.users.create');
        }
        return redirect()->route('dashboard');
    }

    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed',
                'role' => 'required|in:student,admin',
            ]);

            $validated['password'] = bcrypt($validated['password']);
            User::create($validated);

            return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
        }
        return redirect()->route('dashboard');
    }

    public function edit(User $user)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('admin.users.edit', compact('user'));
        }
        return redirect()->route('dashboard');
    }

    public function update(Request $request, User $user)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'role' => 'required|in:student,admin',
            ]);

            // Only update password if provided
            if ($request->filled('password')) {
                $validated['password'] = bcrypt($request->password);
            }

            $user->update($validated);

            return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
        }
        return redirect()->route('dashboard');
    }

    public function destroy(User $user)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            // Prevent admin from deleting themselves
            if ($user->id === Auth::id()) {
                return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own account.');
            }
            
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        }
        return redirect()->route('dashboard');
    }
}