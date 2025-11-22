<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Dashboard</title>
    <style>
        /* Sidebar  */
        .sidebar {
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: #2a1520;
            z-index: 1000;
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(.4,0,.2,1);
            box-shadow: 2px 0 16px rgba(0,0,0,0.08);
            padding-top: 32px;
            gap: 12px;
        }

        .sidebar-item {
            padding: 12px 16px;
            background: rgba(245, 230, 211, 0.1);
            border-left: 3px solid transparent;
            border-radius: 8px;
            color: #f5e6d3;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 500;
        }
        .sidebar.open {
            transform: translateX(0);
        }
        .sidebar-item:hover {
            background: rgba(245, 230, 211, 0.15);
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
            background: #d4a5a0;
            border-left-color: #c85a54;
            color: #2a1520;
            font-weight: 600;
        }
        .sidebar.open ~ .sidebar-overlay {
            display: block;
        }
        .sidebar-toggle-btn {
            display: inline-block;
            background: #2a1520;
            color: #f5e6d3;
            border: none;
            font-size: 24px;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            margin-right: 16px;
        }
        @media (min-width: 1025px) {
            .sidebar {
                position: fixed;
                transform: none !important;
                height: 100vh;
                width: 260px;
                box-shadow: 2px 0 16px rgba(0,0,0,0.08);
            }
            .sidebar-overlay, .sidebar-toggle-btn {
                display: none !important;
            }
            .main-grid {
                margin-left: 260px;
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
            background: linear-gradient(135deg, #3d1f2e 0%, #2a1520 100%);
            min-height: 100vh;
            padding: 24px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #f5e6d3;
        }
        .nav {
            display: flex;
            gap: 32px;
            align-items: center;
        }

        .nav a {
            color: #f5e6d3;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: opacity 0.2s;
        }

        .nav a.active {
            border-bottom: 2px solid #c85a54;
            padding-bottom: 4px;
        }

        .nav a:hover {
            opacity: 0.8;
        }

        .user-menu {
            color: #f5e6d3;
            font-size: 14px;
        }

        /* Main Grid */
        .main-grid {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 24px;
            margin-bottom: 32px;
        }

        /* Left Column */
        .left-column {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Card Base Styles */
        .card {
            background: #f5e6d3;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
        }

        /* Upcoming Tasks Card */
        .upcoming-tasks {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: #3d1f2e;
            letter-spacing: 0.5px;
        }

        .task-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .task-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: #f9f2e8;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .task-item:hover {
            background: #f3e9de;
        }

        .task-checkbox {
            width: 20px;
            height: 20px;
            min-width: 20px;
            border: 2px solid #c85a54;
            border-radius: 6px;
            cursor: pointer;
            accent-color: #c85a54;
        }

        .task-text {
            font-size: 14px;
            color: #3d1f2e;
            font-weight: 500;
        }

        /* Progress Card */
        .progress-card {
            display: flex;
            flex-direction: column;
            gap: 20px;
            grid-column: 1;
        }

        .progress-bar {
            width: 100%;
            height: 12px;
            background: #e8dcd0;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            width: 78%;
            background: linear-gradient(90deg, #c85a54 0%, #a64640 100%);
            border-radius: 10px;
            transition: width 0.3s ease;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: #6b4a42;
            font-weight: 600;
        }

        /* Leaderboard Card */
        .leaderboard-card {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .leaderboard-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .leaderboard-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 14px;
            background: #f9f2e8;
            border-radius: 10px;
            font-size: 14px;
            color: #3d1f2e;
        }

        .leaderboard-rank {
            font-weight: 700;
            color: #c85a54;
            min-width: 24px;
        }

        .leaderboard-name {
            flex: 1;
            margin-left: 12px;
            font-weight: 500;
        }

        .leaderboard-percent {
            font-weight: 600;
            color: #6b4a42;
        }

        /* Daily Cards Grid */
        .daily-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .daily-card {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .daily-header {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .daily-date {
            font-size: 16px;
            font-weight: 700;
            color: #3d1f2e;
        }

        .daily-courses {
            font-size: 12px;
            color: #8b6f63;
            font-weight: 500;
        }

        .daily-tasks {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .daily-task {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            background: #f9f2e8;
            border-radius: 8px;
            font-size: 13px;
            color: #3d1f2e;
        }

        .task-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .task-dot.red { background: #c85a54; }
        .task-dot.green { background: #6ba876; }
        .task-dot.blue { background: #5b8fa3; }

        /* Responsive */
        @media (max-width: 1024px) {
            .main-grid {
                grid-template-columns: 1fr;
            }

            .daily-cards {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 16px;
                text-align: center;
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
                padding: 16px;
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
            <div class="logo" style="margin-bottom:24px ;">Student task planner</div>
            <!-- Navigation -->
            <div style="display: flex; flex-direction: column; gap: 8px;">
                <div class="sidebar-item active">Home</div>
                <div class="sidebar-item">Add new task</div>
                <div class="sidebar-item">Notes</div>
                <div class="sidebar-item">My Courses</div>
                <div class="sidebar-item">Study Group</div>
                <div class="sidebar-item">Calendar</div>
                <div class="sidebar-item">Reminders</div>
                <div class="sidebar-item">My Projects</div>
                <div class="sidebar-item">Settings</div>
            </div>
        </div>
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        <!-- Main Content -->
        <div style="flex:1;">
            <!-- Header -->
            <div class="header">
                <div class="nav">
                    <a href="app" class="active">Home</a>
                    <a href="courses.create">Courses</a>
                    <a href="tasks.create">Tasks</a>
                    <a href="profile.create">Profile</a>
                </div>
                <div class="user-menu">User Menu</div>
            </div>
            <!-- Main Grid and Content (unchanged) -->
            <div class="main-grid">
                <!-- Left Column -->
                <div class="left-column">
                    <!-- Upcoming Tasks -->
                    <div class="card upcoming-tasks">
                        <div class="card-title">Upcoming Tasks</div>
                        <div class="task-list">
                            <label class="task-item">
                                <input type="checkbox" class="task-checkbox">
                                <span class="task-text">Do this</span>
                            </label>
                            <label class="task-item">
                                <input type="checkbox" class="task-checkbox">
                                <span class="task-text">Do this</span>
                            </label>
                            <label class="task-item">
                                <input type="checkbox" class="task-checkbox">
                                <span class="task-text">Do this</span>
                            </label>
                            <label class="task-item">
                                <input type="checkbox" class="task-checkbox">
                                <span class="task-text">Do this</span>
                            </label>
                            <label class="task-item">
                                <input type="checkbox" class="task-checkbox">
                                <span class="task-text">Do this</span>
                            </label>
                        </div>
                    </div>
                    <!-- Daily Cards (unchanged) -->
                    <div class="daily-cards">
                        <!-- ...existing daily cards... -->
                    </div>
                </div>
                <!-- Right Sidebar (unchanged) -->
                <div class="sidebar" style="position:static;transform:none;box-shadow:none;background:none;padding:0;">
                    <!-- Progress Card -->
                    <div class="card progress-card">
                        <div class="card-title">Progress</div>
                        <div>
                            <div class="progress-bar">
                                <div class="progress-fill"></div>
                            </div>
                            <div class="progress-label" style="margin-top: 10px;">
                                <span>78% Complete</span>
                            </div>
                        </div>
                    </div>
                    <!-- Leaderboard Card -->
                    <div class="card leaderboard-card">
                        <div class="card-title">Leaderboard</div>
                        <div class="leaderboard-list">
                            <div class="leaderboard-item">
                                <span class="leaderboard-rank">1.</span>
                                <span class="leaderboard-name">Nathan</span>
                                <span class="leaderboard-percent">78%</span>
                            </div>
                            <div class="leaderboard-item">
                                <span class="leaderboard-rank">2.</span>
                                <span class="leaderboard-name">Sarah</span>
                                <span class="leaderboard-percent">65%</span>
                            </div>
                            <div class="leaderboard-item">
                                <span class="leaderboard-rank">3.</span>
                                <span class="leaderboard-name">Maria</span>
                                <span class="leaderboard-percent">50%</span>
                            </div>
                            <div class="leaderboard-item">
                                <span class="leaderboard-rank">4.</span>
                                <span class="leaderboard-name">Jerry</span>
                                <span class="leaderboard-percent">45%</span>
                            </div>
                            <div class="leaderboard-item">
                                <span class="leaderboard-rank">5.</span>
                                <span class="leaderboard-name">Arnie</span>
                                <span class="leaderboard-percent">30%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('open');
            sidebarOverlay.classList.toggle('open');
        });
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('open');
        });
    </script>
</body>
</html>