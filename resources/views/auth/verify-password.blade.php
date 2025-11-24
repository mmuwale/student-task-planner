<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Your Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-100">
<div class="w-full max-w-md bg-[#f7ecf0] border border-[#e0c1cd] rounded-xl shadow-sm p-8">
    <div class="mb-6 text-center">
        <img src="{{ asset('logo_transparent.png') }}" alt="Logo" class="h-10 mx-auto mb-1" />
        <h1 class="text-xl font-semibold text-slate-800">Verify Your Account</h1>
        <p class="text-sm text-slate-500 mt-1">Enter the verification token sent to your email to activate your account.</p>
    </div>
    @if(session('error'))
        <div class="mb-3 text-xs text-red-600 text-center bg-red-50 border border-red-200 rounded-md py-2 px-3">
            {{ session('error') }}
        </div>
    @endif
    <form method="POST" action="{{ route('verify-password.submit') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">Verification Token</label>
            <input type="text" name="token" required autofocus
                   class="w-full border border-[#d2aabb] rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#800020]/60">
        </div>
        <button type="submit"
                class="w-full mt-2 bg-[#800020] text-white text-sm font-medium py-2 rounded-md hover:bg-[#5e0617] transition">
            Verify & Continue
        </button>
    </form>
</div>
</body>
</html>
