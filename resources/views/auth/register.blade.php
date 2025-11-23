@extends('layouts.app')

@section('title', 'Register')
@section('content')
<div style="max-width: 400px; margin: 80px auto; background: #f5e6d3; border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,0.10); padding: 40px 32px;">
    <h2 style="text-align: center; color: #3d1f2e; margin-bottom: 32px;">Sign Up</h2>
    <form method="POST" action="#">
        @csrf
        <div style="margin-bottom: 20px;">
            <label for="name" style="display: block; color: #683844; font-weight: 600; margin-bottom: 6px;">Name</label>
            <input type="text" id="name" name="name" required autofocus style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 15px;">
        </div>
        <div style="margin-bottom: 20px;">
            <label for="email" style="display: block; color: #683844; font-weight: 600; margin-bottom: 6px;">Email</label>
            <input type="email" id="email" name="email" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 15px;">
        </div>
        <div style="margin-bottom: 20px;">
            <label for="password" style="display: block; color: #683844; font-weight: 600; margin-bottom: 6px;">Password</label>
            <input type="password" id="password" name="password" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 15px;">
        </div>
        <div style="margin-bottom: 24px;">
            <label for="password_confirmation" style="display: block; color: #683844; font-weight: 600; margin-bottom: 6px;">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 15px;">
        </div>
        <button type="submit" style="width: 100%; background: linear-gradient(90deg, #cc4c46ff 0%, #891d1a 100%); color: #fff; border: none; border-radius: 8px; padding: 14px 0; font-size: 16px; font-weight: 600; cursor: pointer; transition: background 0.2s;">Register</button>
    </form>
    <div style="text-align: center; margin-top: 24px; font-size: 14px; color: #683844;">
        Already have an account? <a href="#" style="color: #cc4c46; text-decoration: none;">Sign in</a>
    </div>
</div>
@endsection
