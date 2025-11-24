<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Task Planner</title>
    <link rel="icon" type="image/png" href="{{ asset('logo_transparent.png') }}">
    <style>
        .sidebar-item {
            text-decoration: none !important;
        }
        @media (min-width: 1525px) {
            .header {
                margin-left: 100px;
            }
        }
        /* Sidebar  */
        .sidebar {
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: linear-gradient(180deg, #210706 0%, #391016 100%);
            z-index: 1000;
            transform: translateX(-100%);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 2px 0 16px rgba(0,0,0,0.08);
            padding-top: 32px;
            gap: 12px;
            overflow: hidden;
        }

        .sidebar.hide {
            transform: translateX(-100%);
            width: 0;
            opacity: 0;
        }

        .sidebar:not(.hide) {
            transform: translateX(0);
            width: 260px;
            opacity: 1;
        }

        .sidebar-item {
            padding: 12px 16px;
            background: rgba(241, 230, 210, 0.1);
            border-left: 3px solid transparent;
            border-radius: 8px;
            color: #f0f6f7;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
        }
        .sidebar.open {
            transform: translateX(0);
        }
        .sidebar-item:hover {
            background: rgba(241, 230, 210, 0.2);
            border-left-color: #f1e6d2;
        }
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.2);
            z-index: 999;
        }
        .sidebar-item.active {
            background: rgba(241, 230, 210, 0.25);
            border-left-color: #f1e6d2;
            color: #f0f6f7;
            font-weight: 600;
        }
        .sidebar.open ~ .sidebar-overlay {
            display: block;
        }
        .sidebar-toggle-btn {
            display: inline-block;
            background: #891d1a;
            color: #f0f6f7;
            border: none;
            font-size: 24px;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            margin-right: 16px;
            transition: background 0.2s;
        }
        .sidebar-toggle-btn:hover {
            background: #a82a26;
        }
        @media (min-width: 1025px) {
            .sidebar {
                position: fixed;
                transform: none !important;
                height: 100vh;
                width: 260px;
                box-shadow: 2px 0 16px rgba(0,0,0,0.08);
                opacity: 1 !important;
            }
            
            .sidebar.hide {
                width: 0 !important;
                opacity: 0 !important;
                transform: translateX(-100%) !important;
            }
            
            .sidebar-overlay, .sidebar-toggle-btn {
                display: none !important;
            }
            .main-grid {
                margin-left: 260px;
                transition: margin-left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .main-grid.expanded {
                margin-left: 0;
            }
        }
        @media (max-width: 1024px) {
            .main-grid {
                margin-left: 0;
            }
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #f0f6f7 0%, #e8f0f2 100%);
            min-height: 100vh;
            padding: 24px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            padding: 16px 24px;
            background: linear-gradient(135deg, #891d1a 0%, #a82a26 100%);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(137, 29, 26, 0.2);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 998;
        }

        .header.expanded {
            margin-left: 0;
            width: 100%;
            transform: scale(1.02);
            box-shadow: 0 12px 48px rgba(137, 29, 26, 0.3);
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #f0f6f7;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 8px 16px;
            border-radius: 12px;
        }
        
        .logo:hover {
            background: rgba(241, 230, 210, 0.1);
            transform: scale(1.05);
        }
        
        .logo-icon {
            font-size: 28px;
            background: #f1e6d2;
            color: #891d1a;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .logo:hover .logo-icon {
            transform: rotate(15deg) scale(1.1);
        }

        .nav {
            display: flex;
            gap: 60px;
            align-items: center;
        }

        .nav a {
            color: #f0f6f7;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.2s;
            padding: 8px 16px;
            border-radius: 8px;
        }

        .nav a.active {
            background: rgba(241, 230, 210, 0.25);
            border-bottom: 3px solid #f1e6d2;
        }
        .user-menu.active {
            border-bottom: none !important;
            padding-bottom: 0 !important;
        }

        .nav a:hover {
            background: rgba(241, 230, 210, 0.2);
            transform: translateY(-2px);
        }

        .user-menu {
            color: #f0f6f7;
            font-size: 16px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: #f1e6d2;
            color: #891d1a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Main Grid */
        .main-grid {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 24px;
            margin-bottom: 2px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Left Column */
        .left-column {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Card Base Styles */
        .card {
            background: #ffffff;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 12px 40px rgba(137, 29, 26, 0.1);
            border: 1px solid rgba(241, 230, 210, 0.3);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 60px rgba(137, 29, 26, 0.15);
        }

        /* Upcoming Tasks Card */
        .upcoming-tasks {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .card-title {
            font-size: 20px;
            font-weight: 800;
            color: #210706;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .card-title i {
            color: #891d1a;
            font-size: 24px;
        }

        .task-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .task-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            background: #f8f9fa;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
            border-left: 4px solid transparent;
        }

        .task-item:hover {
            background: #f1e6d2;
            border-left-color: #891d1a;
            transform: translateX(4px);
        }

        .task-checkbox {
            width: 22px;
            height: 22px;
            min-width: 22px;
            border: 2px solid #891d1a;
            border-radius: 6px;
            cursor: pointer;
            accent-color: #891d1a;
        }

        .task-text {
            font-size: 16px;
            color: #210706;
            font-weight: 600;
            flex: 1;
        }

        .task-meta {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .task-priority {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .priority-high { background: #ff6b6b; color: white; }
        .priority-medium { background: #ffd93d; color: #210706; }
        .priority-low { background: #6bcf7f; color: white; }

        /* Progress Card */
        .progress-card {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .progress-container {
            background: #f8f4eb;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            border: 1px solid rgba(241, 230, 210, 0.5);
        }

        .progress-bar {
            width: 100%;
            height: 20px;
            background: #e9ecef;
            border-radius: 10px;
            overflow: hidden;
            margin: 16px 0;
        }

        .progress-fill {
            height: 100%;
            width: 78%;
            background: linear-gradient(90deg, #891d1a 0%, #cc4c46 100%);
            border-radius: 10px;
            transition: width 0.3s ease;
            position: relative;
        }

        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 16px;
            color: #210706;
            font-weight: 700;
        }

        .progress-percent {
            font-size: 32px;
            font-weight: 800;
            color: #891d1a;
            margin: 8px 0;
        }

        /* Leaderboard Card */
        .leaderboard-card {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .leaderboard-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .leaderboard-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 20px;
            background: #f8f9fa;
            border-radius: 12px;
            font-size: 16px;
            color: #210706;
            transition: all 0.2s;
        }

        .leaderboard-item:hover {
            background: #f1e6d2;
            transform: translateX(4px);
        }

        .leaderboard-rank {
            font-weight: 800;
            color: #891d1a;
            min-width: 30px;
            font-size: 18px;
        }

        .leaderboard-name {
            flex: 1;
            margin-left: 16px;
            font-weight: 600;
        }

        .leaderboard-percent {
            font-weight: 700;
            color: #891d1a;
            font-size: 18px;
        }

        /* Daily Cards Grid */
        .daily-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 24px;
        }

        .daily-card {
            display: flex;
            background: linear-gradient(135deg, #ffffff 0%, #f8f4eb 100%);
            flex-direction: column;
            gap: 20px;
            padding: 24px;
            border-radius: 16px;
            border: 1px solid rgba(241, 230, 210, 0.5);
            transition: all 0.3s;
        }

        .daily-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 48px rgba(137, 29, 26, 0.15);
        }

        .daily-header {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .daily-date {
            font-size: 18px;
            font-weight: 800;
            color: #210706;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .daily-date::before {
            content: '📅';
            font-size: 20px;
        }

        .daily-courses {
            font-size: 14px;
            color: #891d1a;
            font-weight: 600;
        }

        .daily-tasks {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .daily-task {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: #f8f9fa;
            border-radius: 10px;
            font-size: 14px;
            color: #210706;
            transition: all 0.2s;
        }

        .daily-task:hover {
            background: #f1e6d2;
        }

        .task-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .task-dot.red { background: #891d1a; }
        .task-dot.green { background: #6ba876; }
        .task-dot.blue { background: #5b8fa3; }
        .task-dot.purple { background: #8b6fa3; }

        /* Content shifting for mobile sidebar - APPLIES TO ALL PAGES */
        .main-content-container {
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), margin-right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .main-grid {
                grid-template-columns: 1fr;
            }

            .daily-cards {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            }
        }
        /* footer */
        .footer {
            background: linear-gradient(135deg, #891d1a 0%, #210706 100%);
            color: #f1e6d2;
            padding: 40px 0;
            text-align: center;
            font-size: 14px;
            position: relative;
            margin-top: 48px;
            border-radius: 16px;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 16px;
                text-align: center;
                padding: 20px;
            }

            .nav {
                flex-wrap: wrap;
                justify-content: center;
                gap: 16px;
            }

            .daily-cards {
                grid-template-columns: 1fr;
            }

            body {
                padding: 16px;
            }

            .card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar Toggle Button (mobile/desktop) -->
        <button class="sidebar-toggle-btn" id="sidebarToggle" aria-label="Open sidebar">☰</button>
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <!-- Medium Centered Logo -->
            <div style="display: flex; justify-content: center; align-items: center; height: 18%; min-height: 100px; background: none;">
                <img src="{{ asset('logo_2.png') }}" alt="Logo" style="max-height: 80%; max-width: 60%; object-fit: contain; display: block;">
            </div>
            @include('layouts.partials.navigation')
        </div>
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        <!-- Main Content -->
        <div class="main-content-container" id="mainContent" style="flex:1; display: flex; flex-direction: column;">
            <!-- Enhanced Header -->
            <div class="header" id="mainHeader">
                <div class="logo" id="headerLogo">
                    <div class="logo-icon"><img src="{{ asset('logo.png') }}" alt="Logo" style="width:32px;height:32px;border-radius:50%;"></div>
                    <span>Student Task Planner</span>
                </div>
                <div class="nav">
                    <a href="{{ route('courses') }}" class="{{ request()->routeIs('courses.*') ? 'active' : '' }}">Courses</a>
                    <a href="{{ route('tasks') }}" class="{{ request()->routeIs('tasks.*') ? 'active' : '' }}">Tasks</a>
                    <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">Profile</a>
                </div>
                <div class="user-menu">
                    @if(Auth::check())
                        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                        <span>Welcome, {{ Auth::user()->name }}!</span>
                    @else
                        <div class="user-avatar">?</div>
                        <span>Welcome, Guest!</span>
                    @endif
                </div>
            </div>

            <!-- Main Grid and Content -->
            @if (request()->is('/'))
                <div class="main-grid" id="mainGrid">
                    <!-- Left Column -->
                    <div class="left-column">
                        <!-- Upcoming Tasks -->
                        <div class="card upcoming-tasks">
                            <h2 class="card-title">
                                <i class="fas fa-tasks"></i>
                                UPCOMING TASKS
                            </h2>
                            <div class="task-list">
                                @foreach($upcomingTasks as $task)
                                <div class="task-item">
                                    <input type="checkbox" class="task-checkbox" id="task-{{ $task->id }}" 
                                           {{ $task->status == 'completed' ? 'checked' : '' }}>
                                    <label class="task-text" for="task-{{ $task->id }}">{{ $task->title }}</label>
                                    <div class="task-meta">
                                        <span class="task-priority priority-{{ $task->priority }}">{{ $task->priority }}</span>
                                        <small style="color: #6b7280;">{{ $task->due_date->format('M j') }}</small>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Daily Cards -->
                        <div class="daily-cards">
                            @foreach($weekDays as $day)
                            <div class="daily-card">
                                <div class="daily-header">
                                    <div class="daily-date">{{ $day['name'] }} • {{ $day['date'] }}</div>
                                    <div class="daily-courses">
                                        @foreach($day['courses'] as $course)
                                        <span>{{ $course }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="daily-tasks">
                                    @foreach($day['tasks'] as $task)
                                    <div class="daily-task">
                                        <div class="task-dot {{ $task['color'] }}"></div>
                                        <span>{{ $task['title'] }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Right Sidebar -->
                    <div style="display: flex; flex-direction: column; gap: 24px;">
                        <!-- Progress Card -->
                        <div class="card progress-card">
                            <h2 class="card-title">
                                <i class="fas fa-chart-line"></i>
                                PROGRESS
                            </h2>
                            <div class="progress-container">
                                <div class="progress-percent">{{ $completionRate }}%</div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ $completionRate }}%"></div>
                                </div>
                                <div class="progress-label">
                                    <span>Complete</span>
                                    <span>{{ $completedTasks }}/{{ $totalTasks }} Tasks</span>
                                </div>
                            </div>
                        </div>

                        <!-- Leaderboard Card -->
                        <div class="card leaderboard-card">
                            <h2 class="card-title">
                                <i class="fas fa-trophy"></i>
                                LEADERBOARD
                            </h2>
                            <div class="leaderboard-list">
                                @foreach($leaderboard as $index => $user)
                                <div class="leaderboard-item">
                                    <span class="leaderboard-rank">{{ $index + 1 }}</span>
                                    <span class="leaderboard-name">{{ $user->name }}</span>
                                    <span class="leaderboard-percent">{{ $user->completion_rate }}%</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- This applies to ALL other pages (Study Group, Calendar, Reminders, etc.) -->
                <div class="page-content">
                    @yield('content')
                </div>
            @endif
        </div>

        <footer class="footer" style="margin-top: auto;">
            <a href="#" style="color: #f0f6f7; text-decoration: none; font-weight: 600;">
                &copy; {{ date('Y') }} Student Task Planner. All rights reserved.
            </a>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const headerLogo = document.getElementById('headerLogo');
            const sidebar = document.getElementById('sidebar');
            const header = document.getElementById('mainHeader');
            const mainGrid = document.getElementById('mainGrid');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const mainContent = document.getElementById('mainContent');
            
            let isSidebarHidden = false;

            // Function to shift content when sidebar is open - WORKS FOR ALL PAGES
            function shiftContent(shouldShift) {
                if (window.innerWidth < 1025 && mainContent) {
                    if (shouldShift) {
                        mainContent.style.transform = 'translateX(260px)';
                        mainContent.style.marginRight = '-260px';
                    } else {
                        mainContent.style.transform = 'translateX(0)';
                        mainContent.style.marginRight = '0';
                    }
                }
            }

            // Header logo toggles sidebar and expands header
            headerLogo.addEventListener('click', function() {
                isSidebarHidden = !isSidebarHidden;
                
                if (isSidebarHidden) {
                    // Hide sidebar and expand header
                    sidebar.classList.add('hide');
                    header.classList.add('expanded');
                    if (mainGrid) mainGrid.classList.add('expanded');
                    shiftContent(false);
                } else {
                    // Show sidebar and collapse header
                    sidebar.classList.remove('hide');
                    header.classList.remove('expanded');
                    if (mainGrid) mainGrid.classList.remove('expanded');
                    if (window.innerWidth < 1025) {
                        shiftContent(true);
                    }
                }
            });

            // Mobile sidebar toggle - FIXED
            sidebarToggle.addEventListener('click', function() {
                const isOpening = !sidebar.classList.contains('open');
                sidebar.classList.toggle('open');
                sidebarOverlay.style.display = isOpening ? 'block' : 'none';
                shiftContent(isOpening);
            });
            
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('open');
                this.style.display = 'none';
                shiftContent(false);
            });

            // Task completion animation (only for home page)
            document.querySelectorAll('.task-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const taskItem = this.closest('.task-item');
                    if (this.checked) {
                        taskItem.style.opacity = '0.7';
                        taskItem.style.textDecoration = 'line-through';
                    } else {
                        taskItem.style.opacity = '1';
                        taskItem.style.textDecoration = 'none';
                    }
                });
            });

            // Handle responsive behavior - IMPROVED
            function handleResize() {
                if (window.innerWidth >= 1025) {
                    // Desktop: ensure proper state
                    sidebar.classList.remove('open');
                    sidebarOverlay.style.display = 'none';
                    sidebarToggle.style.display = 'none';
                    shiftContent(false);
                    
                    if (!isSidebarHidden) {
                        sidebar.classList.remove('hide');
                        header.classList.remove('expanded');
                        if (mainGrid) mainGrid.classList.remove('expanded');
                    }
                } else {
                    // Mobile: reset expanded state and show toggle button
                    sidebarToggle.style.display = 'inline-block';
                    header.classList.remove('expanded');
                    if (mainGrid) mainGrid.classList.remove('expanded');
                    sidebar.classList.remove('hide');
                    shiftContent(sidebar.classList.contains('open'));
                    
                    // Ensure sidebar starts closed on mobile
                    if (!sidebar.classList.contains('open')) {
                        sidebar.classList.remove('open');
                        sidebarOverlay.style.display = 'none';
                        shiftContent(false);
                    }
                }
            }

            window.addEventListener('resize', handleResize);
            handleResize(); // Initial check

            // Close sidebar when clicking on sidebar items on mobile
            document.querySelectorAll('.sidebar-item').forEach(item => {
                item.addEventListener('click', function() {
                    if (window.innerWidth < 1025) {
                        sidebar.classList.remove('open');
                        sidebarOverlay.style.display = 'none';
                        shiftContent(false);
                    }
                });
            });
        });
    </script>
</body>
</html>