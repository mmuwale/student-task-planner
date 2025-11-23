@extends('layouts.app')

@section('title', 'Verify Email')

@section('content')
<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f0f6f7 0%, #e8f0f2 100%); padding: 20px;">
    <div style="max-width: 440px; width: 100%; background: #ffffff; border-radius: 20px; box-shadow: 0 12px 40px rgba(137, 29, 26, 0.1); padding: 48px 40px; border: 1px solid rgba(241, 230, 210, 0.3);">
        <!-- Logo -->
        <div style="text-align: center; margin-bottom: 32px;">
            <h3 style="color: #210706; font-size: 28px; font-weight: 700; margin: 0;">Verify Your Email</h3>
            <p style="color: #6b7280; margin-top: 8px; font-size: 14px; line-height: 1.5;">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div style="background: #f8f4eb; border: 1px solid rgba(137, 29, 26, 0.2); border-radius: 12px; padding: 16px; margin-bottom: 24px; color: #210706; font-size: 14px;">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <div style="display: flex; flex-direction: column; gap: 16px;">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" 
                        style="width: 100%; background: linear-gradient(90deg, #891d1a 0%, #a82a26 100%); color: #ffffff; border: none; border-radius: 12px; padding: 16px 0; font-size: 16px; font-weight: 700; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(137, 29, 26, 0.3);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(137, 29, 26, 0.4)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(137, 29, 26, 0.3)';">
                    Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        style="width: 100%; background: transparent; color: #891d1a; border: 2px solid #891d1a; border-radius: 12px; padding: 14px 0; font-size: 16px; font-weight: 700; cursor: pointer; transition: all 0.2s;"
                        onmouseover="this.style.backgroundColor='#891d1a'; this.style.color='#ffffff';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#891d1a';">
                    Log Out
                </button>
            </form>
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