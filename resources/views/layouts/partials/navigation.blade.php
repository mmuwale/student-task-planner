
<div style="display: flex; flex-direction: column; gap: 8px;">
    <a href="{{ route('dashboard') }}" class="sidebar-item{{ request()->is('/') || request()->is('dashboard') ? ' active' : '' }}">Home</a>
    <a href="{{ route('courses.index') }}" class="sidebar-item{{ request()->is('courses*') ? ' active' : '' }}">My Courses</a>
    <a href="/tasks" class="sidebar-item{{ request()->is('tasks*') ? ' active' : '' }}">Tasks</a>
    <a href="{{ route('study-group.index') }}" class="sidebar-item{{ request()->is('study-group*') ? ' active' : '' }}">Study Group</a>
    <a href="/calendar" class="sidebar-item{{ request()->is('calendar*') ? ' active' : '' }}">Calendar</a>
    <a href="/reminders" class="sidebar-item{{ request()->is('reminders*') ? ' active' : '' }}">Reminders</a>
    <a href="{{ route('settings.index') }}" class="sidebar-item{{ request()->is('settings*') ? ' active' : '' }}">Settings</a>
    
    <!-- Admin Only Links -->
    @auth
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.users.index') }}" class="sidebar-item{{ request()->is('admin/users*') ? ' active' : '' }}">
                User Management
            </a>
        @endif
    @endauth
</div>
