<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class VerifyPasswordController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $data = $request->session()->get('registration_data');
        if ($data && $request->token === $data['email_verification_token']) {
            $user = \App\Models\User::create($data + ['email_verified_at' => now()]);
            Auth::login($user);
            $request->session()->forget('registration_data');
            return Redirect::route('dashboard')->with('status', 'Account verified!');
        }
        return Redirect::route('verify-password')->with('error', 'Invalid verification token. Please check your email and try again.');
    }
}
