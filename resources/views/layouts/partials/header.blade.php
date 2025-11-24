<div class="header" id="mainHeader">
    <div class="logo" id="headerLogo">
        <div class="logo-icon"><img src="{{ asset('logo.png') }}" alt="Logo" style="width:32px;height:32px;border-radius:50%;"></div>
        <span>Student Task Planner</span>
    </div>
    <!-- User Menu / Auth Links -->
    @if(Auth::check())
        <div class="user-menu" id="userMenu">
            <div class="user-avatar" id="userAvatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <span>Welcome, {{ Auth::user()->name }}!</span>
            <div id="avatarDropdown" class="avatar-dropdown">
                <a href="{{ route('profile') }}">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    @else
        <div class="auth-links">
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
    @endif
</div>
