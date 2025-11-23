@extends('layouts.app')

@section('content')
    <div class="main-grid">
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
@endsection
