<div style="display: flex; flex-direction: column; gap: 8px;">
    <a href="/" class="sidebar-item{{ request()->is('/') ? ' active' : '' }}">Home</a>
    <a href="{{ route('courses') }}" class="sidebar-item{{ request()->is('courses') ? ' active' : '' }}">My Courses</a>
    <a href="{{ route('tasks') }}" class="sidebar-item{{ request()->routeIs('tasks.*') ? ' active' : '' }}">Tasks</a>
    <a href="{{ route('study-group.index') }}" class="sidebar-item{{ request()->routeIs('study-group.index') ? ' active' : '' }}">Study Group</a>
    <a href="/calendar" class="sidebar-item{{ request()->is('calendar') ? ' active' : '' }}">Calendar</a>
    <a href="/reminders" class="sidebar-item{{ request()->is('reminders.php') ? ' active' : '' }}">Reminders</a>
    <a href="{{ route('settings.index') }}" class="sidebar-item{{ request()->routeIs('settings.index') ? ' active' : '' }}">Settings</a>
</div>
