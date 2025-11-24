@extends('layouts.app')

@section('title', 'Profile')
@section('content')
<div class="min-h-screen flex items-start justify-center bg-gradient-to-br from-[#f0f6f7] to-[#e8f0f2] pt-10 pb-0">
    <div class="max-w-md w-full bg-[#f8f4eb] rounded-2xl shadow-xl p-12 border border-[#f1e6d2] flex flex-col items-stretch">
        <h2 class="text-left text-[#210706] mb-8 text-3xl font-extrabold">My Profile</h2>
        @if(session('status'))
            <div class="bg-[#e8f0f2] text-[#210706] rounded-xl p-4 mb-6 text-base text-center">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('profile.update') }}" class="flex flex-col gap-6">
            @csrf
            @method('PATCH')
            <div>
                <label for="name" class="block text-[#891d1a] font-bold text-lg mb-2">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full px-4 py-3 rounded-xl border border-[#e8f0f2] bg-white text-[#210706] text-base" />
            </div>
            <div>
                <label for="email" class="block text-[#891d1a] font-bold text-lg mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full px-4 py-3 rounded-xl border border-[#e8f0f2] bg-white text-[#210706] text-base" />
            </div>
            <div class="mt-6 flex gap-4 justify-end">
                <button type="submit" class="rounded-xl bg-gradient-to-br from-[#891d1a] to-[#a82a26] text-white font-bold px-8 py-3 border-none shadow-md transition-colors">Update Profile</button>
        </form>
        <form method="POST" action="{{ route('profile.destroy') }}" class="m-0">
            @csrf
            @method('DELETE')
            <button type="submit" class="rounded-xl font-bold px-8 py-3 bg-[#891d1a] text-white border-none">Delete Profile</button>
        </form>
            </div>
    </div>
</div>
@endsection
