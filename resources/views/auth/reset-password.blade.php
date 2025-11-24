
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password – Student Planner</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-100">
<div class="w-full max-w-md bg-[#f7ecf0] border border-[#e0c1cd] rounded-xl shadow-sm p-8">
    <div class="mb-6 text-center">
        <img src="{{ asset('logo_2.png') }}" alt="Logo" class="h-10 mx-auto mb-1" />
        <h1 class="text-xl font-semibold text-slate-800">Set New Password</h1>
        <p class="text-sm text-slate-500 mt-1">Enter your new password below</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">Email Address</label>
            <input type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="email"
                   class="w-full border border-[#d2aabb] rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#800020]/60">
            @error('email')
                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">New Password</label>
            <input type="password" name="password" required autocomplete="new-password"
                   class="w-full border border-[#d2aabb] rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#800020]/60">
            @error('password')
                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" required autocomplete="new-password"
                   class="w-full border border-[#d2aabb] rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#800020]/60">
            @error('password_confirmation')
                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit"
                class="w-full mt-2 bg-[#800020] text-white text-sm font-medium py-2 rounded-md hover:bg-[#5e0617] transition">
            Reset Password
        </button>
    </form>

    <p class="mt-5 text-xs text-center text-slate-600">
        Remember your password?
        <a href="{{ route('login') }}" class="text-[#800020] font-semibold hover:underline">Back to login</a>
    </p>
</div>
</body>
</html>