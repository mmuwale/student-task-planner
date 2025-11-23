<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login – Student Planner</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-100">
<div class="w-full max-w-md bg-[#f7ecf0] border border-[#e0c1cd] rounded-xl shadow-sm p-8">
    <div class="mb-6 text-center">
        <div class="text-sm font-semibold tracking-wide text-[#800020] mb-1">LOGO</div>
        <h1 class="text-xl font-semibold text-slate-800">Login</h1>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">Username</label>
            <input type="text" name="email"
                   class="w-full border border-[#d2aabb] rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#800020]/60">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">Password</label>
            <input type="password" name="password"
                   class="w-full border border-[#d2aabb] rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#800020]/60">
        </div>
        <button type="submit"
                class="w-full mt-2 bg-[#800020] text-white text-sm font-medium py-2 rounded-md hover:bg-[#5e0617] transition">
            Login
        </button>
    </form>

    <p class="mt-5 text-xs text-center text-slate-600">
        Don’t have an account?
        <a href="{{ route('register') }}" class="text-[#800020] font-semibold hover:underline">Get started with us</a>
    </p>
</div>
</body>
</html>
