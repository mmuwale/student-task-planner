<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Student Planner')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-100 text-slate-900">
<div x-data="{ sidebarOpen: true }" class="min-h-screen flex">

    {{-- Sidebar --}}
    <aside
        class="bg-[#4b1025] text-slate-50 flex flex-col transition-all duration-300 ease-in-out"
        :class="sidebarOpen ? 'w-60' : 'w-16'">

        {{-- Top / toggle --}}
        <div class="flex items-center justify-between px-3 py-4 border-b border-[#72213c]">
            <div class="flex items-center gap-2">
                <div class="h-12 w-12 rounded-full bg-[#800020] flex items-center justify-center text-xs font-bold overflow-hidden">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="h-12 w-12 object-cover" />
                </div>
                <div x-show="sidebarOpen" class="text-xs leading-tight">
                    <div class="font-semibold tracking-wide">Student Task Planner</div>
                </div>
            </div>

            <button
                @click="sidebarOpen = !sidebarOpen"
                class="ml-2 h-7 w-7 flex items-center justify-center rounded-md bg-[#800020] hover:bg-[#a21c3b] text-[11px]">
                <span x-show="sidebarOpen">«</span>
                <span x-show="!sidebarOpen">»</span>
            </button>
        </div>

        {{-- Main nav --}}
        <nav class="flex-1 px-2 py-3 text-xs space-y-1">
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-2 px-2 py-2 rounded-md
                      @if(request()->routeIs('dashboard')) bg-[#800020] text-white @else hover:bg-[#5e1830] @endif">
                <span class="text-[13px]">🏠</span>
                <span x-show="sidebarOpen">Dashboard</span>
            </a>

            <a href="{{ route('tasks.index') }}"
               class="flex items-center gap-2 px-2 py-2 rounded-md
                      @if(request()->routeIs('tasks.*')) bg-[#800020] text-white @else hover:bg-[#5e1830] @endif">
                <span class="text-[13px]">✅</span>
                <span x-show="sidebarOpen">Tasks</span>
            </a>

            <a href="{{ route('courses.index') }}"
               class="flex items-center gap-2 px-2 py-2 rounded-md
                      @if(request()->routeIs('courses.*')) bg-[#800020] text-white @else hover:bg-[#5e1830] @endif">
                <span class="text-[13px]">📚</span>
                <span x-show="sidebarOpen">My Courses</span>
            </a>

            <a href="{{ route('tasks.completed') }}"
               class="flex items-center gap-2 px-2 py-2 rounded-md hover:bg-[#5e1830] text-xs">
                <span class="text-[13px]">✔</span>
                <span x-show="sidebarOpen">Completed Tasks</span>
            </a>
        </nav>

        {{-- Completed courses --}}
        @isset($completedCourses)
            <div class="px-3 pb-4 border-t border-[#72213c] text-[11px]">
                <p class="mt-3 mb-1 text-[#f2d9e0]" x-show="sidebarOpen">Completed Courses</p>
                <div class="space-y-1 max-h-40 overflow-y-auto pr-1">
                    @foreach($completedCourses as $c)
                        <a href="{{ route('courses.show', $c) }}"
                           class="block text-xs px-2 py-1 rounded-md hover:bg-[#5e1830] truncate">
                            <span x-show="sidebarOpen">{{ $c->name }}</span>
                            <span x-show="!sidebarOpen" class="text-[11px]">✔</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endisset
    </aside>

    {{-- Main content --}}
    <main class="flex-1 flex flex-col transition-all duration-300 ease-in-out">
        <header class="h-14 bg-white border-b border-slate-200 flex items-center justify-between px-6">
            <div>
                <h1 class="text-lg font-semibold text-slate-800">@yield('page_title')</h1>
                @hasSection('page_subtitle')
                    <p class="text-xs text-slate-500">@yield('page_subtitle')</p>
                @endif
            </div>
            <div class="flex items-center gap-3 text-xs text-slate-500">
                {{-- Add Task now goes to full create view --}}
                <a
                    href="{{ route('tasks.create') }}"
                    class="px-3 py-1.5 rounded-full bg-[#800020] text-white text-[11px] hover:bg-[#a21c3b]"
                >
                    + Add Task
                </a>

                <span>{{ auth()->user()->name ?? 'Student' }}</span>
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="px-3 py-1.5 rounded-full border border-[#800020] text-[#800020] hover:bg-[#800020] hover:text-white text-[11px] flex items-center gap-1">
                        Profile
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-36 bg-white rounded-md shadow-lg z-50 border border-slate-200">
                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-xs text-slate-700 hover:bg-slate-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-xs text-[#800020] hover:bg-slate-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <section class="flex-1 p-6">
            @yield('content')
        </section>
    </main>

</div>

@yield('modals')
</body>
</html>
