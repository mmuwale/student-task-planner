@extends('layouts.app')

@section('title', 'Profile')
@section('content')
<h2 style="text-align: left; color: #3d1f2e; margin: 60px 0 32px 0; font-size: 2.2rem; font-weight: 700;">My Profile</h2>
<div style="margin-bottom: 24px;">
    <span style="display: block; color: #683844; font-weight: 700; font-size: 18px; margin-bottom: 8px;">Name</span>
    <span style="color: #3d1f2e; font-size: 17px;">{{ auth()->user()->name ?? 'N/A' }}</span>
</div>
<div style="margin-bottom: 24px;">
    <span style="display: block; color: #683844; font-weight: 700; font-size: 18px; margin-bottom: 8px;">Email</span>
    <span style="color: #3d1f2e; font-size: 17px;">{{ auth()->user()->email ?? 'N/A' }}</span>
</div>

@endsection
