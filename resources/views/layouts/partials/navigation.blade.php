<a href="/" class="sidebar-item {{ request()->is('/') ? 'active' : '' }}">Dashboard</a>
<a href="/courses" class="sidebar-item {{ request()->is('courses') ? 'active' : '' }}">Courses</a>
<a href="/tasks" class="sidebar-item {{ request()->is('tasks') ? 'active' : '' }}">Tasks</a>
<a href="/groups" class="sidebar-item {{ request()->is('groups') ? 'active' : '' }}">Study Groups</a>
<a href="/reminders" class="sidebar-item {{ request()->is('reminders') ? 'active' : '' }}">Reminders</a>

<a href="/calendar" class="sidebar-item {{ request()->is('calendar') ? 'active' : '' }}">Calendar</a>

<a href="/settings" class="sidebar-item {{ request()->is('settings') ? 'active' : '' }}">Settings</a>
