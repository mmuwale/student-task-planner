<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'password' => ['nullable', 'string', 'min:8'],
            '2fa' => ['nullable', 'string', 'in:off,email'],
            'notify_email' => ['nullable'],
        ]);

        // Update password if provided
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        // Save 2FA preference (assuming a 'two_factor' column exists)
        if (isset($data['2fa'])) {
            $user->two_factor = $data['2fa'];
        }

        // Save notification preference (assuming a 'notify_email' column exists)
        $user->notify_email = $request->has('notify_email');

        $user->save();

        return back()->with('success', 'Settings updated!');
    }
}
