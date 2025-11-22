<aside class="sidebar">
    <div class="logo">LOGO</div>
    <ul class="sidebar-menu">
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">Home</a>
        </li>
        <li><a href="#">Add new task</a></li>
        <li><a href="#">Search</a></li>
        <li><a href="#">Notes</a></li>
        <li><a href="#">Calendar</a></li>
        <li><a href="#">Reminders</a></li>
        <li><a href="#">My Projects</a></li>
        <li><a href="#">Inbox</a></li>
        <li><a href="#">Upcoming</a></li>
        <li><a href="#">Archive</a></li>
        <li><a href="#">Settings</a></li>
        <li class="{{ request()->routeIs('courses') ? 'active' : '' }}">
        </li>
    </ul>
</aside>