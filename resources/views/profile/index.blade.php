@extends('layouts.app')

@section('title', 'Profile')
@section('content')
<div style="min-height: 100vh; display: flex; align-items: flex-start; justify-content: center; background: linear-gradient(135deg, #f0f6f7 0%, #e8f0f2 100%); padding: 40px 0 0 0;">
    <div style="max-width: 480px; width: 100%; background: #f8f4eb; border-radius: 20px; box-shadow: 0 12px 40px rgba(137, 29, 26, 0.1); padding: 48px 40px; border: 1px solid rgba(241, 230, 210, 0.3); display: flex; flex-direction: column; align-items: stretch;">
        <h2 style="text-align: left; color: #210706; margin-bottom: 32px; font-size: 2.2rem; font-weight: 800;">My Profile</h2>
        @if(session('status'))
            <div style="background: #e8f0f2; color: #210706; border-radius: 12px; padding: 16px; margin-bottom: 24px; font-size: 15px; text-align: center;">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('profile') }}" style="display: flex; flex-direction: column; gap: 24px;">
            @csrf
            @method('PATCH')
            <div>
                <label for="name" style="display: block; color: #891d1a; font-weight: 700; font-size: 18px; margin-bottom: 8px;">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" style="width: 100%; padding: 14px 16px; border-radius: 12px; border: 1px solid #e8f0f2; background: #fff; color: #210706; font-size: 16px;">
            </div>
            <div>
                <label for="email" style="display: block; color: #891d1a; font-weight: 700; font-size: 18px; margin-bottom: 8px;">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" style="width: 100%; padding: 14px 16px; border-radius: 12px; border: 1px solid #e8f0f2; background: #fff; color: #210706; font-size: 16px;">
            </div>
            <div style="margin-top: 24px; display: flex; gap: 16px; justify-content: flex-end;">
            <form method="POST" action="{{ route('profile') }}" style="margin: 0;">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn" style="border-radius: 12px; background: linear-gradient(135deg, #891d1a 0%, #a82a26 100%); color: #fff; font-weight: 700; padding: 12px 32px; border: none; box-shadow: 0 4px 16px rgba(137,29,26,0.08); transition: background 0.2s;">Update Profile</button>
            </form>
            <form method="POST" action="{{ route('profile.destroy') }}" style="margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" style="border-radius: 12px; font-weight: 700; padding: 12px 32px; background: #891d1a; color: #fff; border: none;">Delete Profile</button>
            </form>
        </div>
    </div>
</div>

@endsection
