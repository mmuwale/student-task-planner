
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password – Student Planner</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-100">
<div class="w-full max-w-md bg-[#f7ecf0] border border-[#e0c1cd] rounded-xl shadow-sm p-8">
    <div class="mb-6 text-center">
        <img src="{{ asset('logo_2.png') }}" alt="Logo" class="h-10 mx-auto mb-1" />
        <h1 class="text-xl font-semibold text-slate-800">Reset Your Password</h1>
        <p class="text-sm text-slate-500 mt-1">Enter your email to receive a password reset link</p>
    </div>

    @if (session('status'))
        <div class="mb-3 text-xs text-green-700 text-center bg-green-50 border border-green-200 rounded-md py-2 px-3">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                   class="w-full border border-[#d2aabb] rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#800020]/60">
            @error('email')
                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit"
                class="w-full mt-2 bg-[#800020] text-white text-sm font-medium py-2 rounded-md hover:bg-[#5e0617] transition">
            Email Password Reset Link
        </button>
    </form>

    <p class="mt-5 text-xs text-center text-slate-600">
        Remember your password?
        <a href="{{ route('login') }}" class="text-[#800020] font-semibold hover:underline">Back to login</a>
    </p>
</div>
</body>
</html>