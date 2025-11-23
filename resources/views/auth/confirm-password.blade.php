@extends('layouts.app')

@section('title', 'Confirm Password')

@section('content')
<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f0f6f7 0%, #e8f0f2 100%); padding: 20px;">
    <div style="max-width: 440px; width: 100%; background: #ffffff; border-radius: 20px; box-shadow: 0 12px 40px rgba(137, 29, 26, 0.1); padding: 48px 40px; border: 1px solid rgba(241, 230, 210, 0.3);">
        <!-- Logo -->
        <div style="text-align: center; margin-bottom: 32px;">
            <h3 style="color: #210706; font-size: 28px; font-weight: 700; margin: 0;">Confirm Password</h3>
            <p style="color: #6b7280; margin-top: 8px; font-size: 14px;">This is a secure area of the application. Please confirm your password before continuing.</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div style="background: #f8f4eb; border: 1px solid rgba(137, 29, 26, 0.2); border-radius: 12px; padding: 16px; margin-bottom: 24px; color: #210706; font-size: 14px;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div style="margin-bottom: 32px;">
                <label for="password" style="display: block; color: #210706; font-weight: 600; margin-bottom: 8px; font-size: 14px;">Password</label>
                <input type="password" id="password" name="password" required autocomplete="current-password"
                       style="width: 100%; padding: 14px 16px; border-radius: 12px; border: 1px solid rgba(241, 230, 210, 0.8); background: #f8f4eb; color: #210706; font-size: 15px; transition: all 0.2s;"
                       onfocus="this.style.borderColor='#891d1a'; this.style.boxShadow='0 0 0 2px rgba(137, 29, 26, 0.1)';"
                       onblur="this.style.borderColor='rgba(241, 230, 210, 0.8)'; this.style.boxShadow='none';">
                @error('password')
                    <div style="color: #dc2626; font-size: 14px; margin-top: 6px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    style="width: 100%; background: linear-gradient(90deg, #891d1a 0%, #a82a26 100%); color: #ffffff; border: none; border-radius: 12px; padding: 16px 0; font-size: 16px; font-weight: 700; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(137, 29, 26, 0.3);"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(137, 29, 26, 0.4)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(137, 29, 26, 0.3)';">
                Confirm Password
            </button>
        </form>

        <!-- Forgot Password Link -->
        <div style="text-align: center; margin-top: 32px; padding-top: 24px; border-top: 1px solid rgba(241, 230, 210, 0.5);">
            <p style="color: #6b7280; font-size: 14px; margin: 0;">
                Forgot your password?
                <a href="{{ route('password.request') }}" style="color: #891d1a; text-decoration: none; font-weight: 600; margin-left: 4px; transition: color 0.2s;"
                   onmouseover="this.style.color='#a82a26';"
                   onmouseout="this.style.color='#891d1a';">
                    Reset it here
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