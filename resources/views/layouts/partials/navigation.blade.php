<div style="display: flex; flex-direction: column; gap: 8px;">
    <a href="/" class="sidebar-item{{ request()->is('/') ? ' active' : '' }}">Home</a>
    <a href="{{ route('courses') }}" class="sidebar-item{{ request()->routeIs('courses') ? ' active' : '' }}">My Courses</a>
    <a href="{{ route('tasks.index') }}" class="sidebar-item{{ request()->routeIs('tasks.*') ? ' active' : '' }}">Tasks</a>
    <a href="{{ route('study-group') }}" class="sidebar-item{{ request()->routeIs('study-group') ? ' active' : '' }}">Study Group</a>
    <a href="{{ route('calendar') }}" class="sidebar-item{{ request()->routeIs('calendar') ? ' active' : '' }}">Calendar</a>
    <a href="{{ route('reminders') }}" class="sidebar-item{{ request()->routeIs('reminders') ? ' active' : '' }}">Reminders</a>
    <a href="{{ route('settings') }}" class="sidebar-item{{ request()->routeIs('settings') ? ' active' : '' }}">Settings</a>
</div>
