<header>
    <nav class="nav-tabs">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            Courses
        </a>
        <a href="{{ route('tasks') }}" class="{{ request()->routeIs('tasks') ? 'active' : '' }}">
            Tasks
        </a>
        <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">
            Profile
        </a>
    </nav>
    <div style="color: #666; font-size: 14px;">User Menu</div>
</header>