@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f0f6f7 0%, #e8f0f2 100%); padding: 20px;">
    <div style="max-width: 440px; width: 100%; background: #ffffff; border-radius: 20px; box-shadow: 0 12px 40px rgba(137, 29, 26, 0.1); padding: 48px 40px; border: 1px solid rgba(241, 230, 210, 0.3);">
        <!-- Logo -->
        <div style="text-align: center; margin-bottom: 32px;">
            <h3 style="color: #210706; font-size: 28px; font-weight: 700; margin: 0;">Welcome Back</h3>
            <p style="color: #6b7280; margin-top: 8px; font-size: 14px;">Sign in to manage your tasks and courses</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div style="background: #f8f4eb; border: 1px solid rgba(137, 29, 26, 0.2); border-radius: 12px; padding: 16px; margin-bottom: 24px; color: #210706; font-size: 14px;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div style="margin-bottom: 20px;">
                <label for="email" style="display: block; color: #210706; font-weight: 600; margin-bottom: 8px; font-size: 14px;">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       style="width: 100%; padding: 14px 16px; border-radius: 12px; border: 1px solid rgba(241, 230, 210, 0.8); background: #f8f4eb; color: #210706; font-size: 15px; transition: all 0.2s;"
                       onfocus="this.style.borderColor='#891d1a'; this.style.boxShadow='0 0 0 2px rgba(137, 29, 26, 0.1)';"
                       onblur="this.style.borderColor='rgba(241, 230, 210, 0.8)'; this.style.boxShadow='none';">
                @error('email')
                    <div style="color: #dc2626; font-size: 14px; margin-top: 6px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div style="margin-bottom: 20px;">
                <label for="password" style="display: block; color: #210706; font-weight: 600; margin-bottom: 8px; font-size: 14px;">Password</label>
                <input type="password" id="password" name="password" required autocomplete="current-password"
                       style="width: 100%; padding: 14px 16px; border-radius: 12px; border: 1px solid rgba(241, 230, 210, 0.8); background: #f8f4eb; color: #210706; font-size: 15px; transition: all 0.2s;"
                       onfocus="this.style.borderColor='#891d1a'; this.style.boxShadow='0 0 0 2px rgba(137, 29, 26, 0.1)';"
                       onblur="this.style.borderColor='rgba(241, 230, 210, 0.8)'; this.style.boxShadow='none';">
                @error('password')
                    <div style="color: #dc2626; font-size: 14px; margin-top: 6px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 32px;">
                <label style="display: flex; align-items: center; gap: 8px; color: #210706; font-size: 14px; cursor: pointer;">
                    <input type="checkbox" id="remember_me" name="remember" 
                           style="width: 16px; height: 16px; border: 2px solid #891d1a; border-radius: 4px; accent-color: #891d1a; cursor: pointer;">
                    Remember me
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" 
                       style="color: #891d1a; text-decoration: none; font-size: 14px; font-weight: 600; transition: color 0.2s;"
                       onmouseover="this.style.color='#a82a26';"
                       onmouseout="this.style.color='#891d1a';">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    style="width: 100%; background: linear-gradient(90deg, #891d1a 0%, #a82a26 100%); color: #ffffff; border: none; border-radius: 12px; padding: 16px 0; font-size: 16px; font-weight: 700; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(137, 29, 26, 0.3);"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(137, 29, 26, 0.4)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(137, 29, 26, 0.3)';">
                Sign In
            </button>
        </form>

        <!-- Register Link -->
        <div style="text-align: center; margin-top: 32px; padding-top: 24px; border-top: 1px solid rgba(241, 230, 210, 0.5);">
            <p style="color: #6b7280; font-size: 14px; margin: 0;">
                Don't have an account?
                <a href="{{ route('register') }}" style="color: #891d1a; text-decoration: none; font-weight: 600; margin-left: 4px; transition: color 0.2s;"
                   onmouseover="this.style.color='#a82a26';"
                   onmouseout="this.style.color='#891d1a';">
                    Create one here
                </a>
            </p>
        </div>
    </div>
</div>

<style>
    /* Additional responsive styles */
    @media (max-width: 480px) {
        .container {
            padding: 20px 16px;
        }
        .form-container {
            padding: 32px 24px;
        }
    }
</style>
@endsection