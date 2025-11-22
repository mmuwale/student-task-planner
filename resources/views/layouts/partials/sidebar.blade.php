<aside class="sidebar">
    <div class="logo">LOGO</div>
    <ul class="sidebar-menu">
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">Home</a>
        </li>
        <li><a href="{{ route('tasks.create') }}">Add new task</a></li>
        <li><a href="{{ route('search') }}">Search</a></li>
        <li><a href="{{ route('notes') }}">Notes</a></li>
        <li><a href="{{ route('calendar') }}">Calendar</a></li>
        <li><a href="{{ route('reminders') }}">Reminders</a></li>
        <li><a href="{{ route('projects') }}">My Projects</a></li>
        <li><a href="{{ route('inbox') }}">Inbox</a></li>
        <li><a href="{{ route('upcoming') }}">Upcoming</a></li>
        <li><a href="{{ route('archive') }}">Archive</a></li>
        <li><a href="{{ route('settings') }}">Settings</a></li>
        <li class="{{ request()->routeIs('courses') ? 'active' : '' }}">
            <a href="{{ route('courses') }}">Courses</a>
        </li>
    </ul>
</aside>