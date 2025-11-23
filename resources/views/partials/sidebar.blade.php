<aside class="sidebar">
    <div class="logo">LOGO</div>
    <ul class="sidebar-menu">
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">Home</a>
        </li>
        <li><a href="{{ route('tasks.create') }}">Add new task</a></li>
        <li><a href="{{ route('calendar') }}">Calendar</a></li>
        <li><a href="{{ route('reminders') }}">Reminders</a></li>
        <li><a href="{{ route('settings') }}">Settings</a></li>
        <li class="{{ request()->routeIs('courses') ? 'active' : '' }}">
            <a href="{{ route('courses') }}">Courses</a>
        </li>
        <li>    
            <a href="{{ route('tasks.completed') }}"
                class="flex items-center gap-2 px-2 py-2 rounded-md hover:bg-[#5e1830] text-xs">
                <span class="text-[13px]">✔</span>
                <span x-show="sidebarOpen">Completed Tasks</span>
            </a>
        </li>
    </ul>
</aside>
