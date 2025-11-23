@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-content">
    <div class="dashboard-grid">
        <!-- Upcoming Tasks -->
        <div class="upcoming-tasks">
            <h3>UPCOMING TASKS</h3>
            <ul class="task-list">
                @foreach($upcomingTasks as $task)
                    <li>
                        <input type="radio" id="task-{{ $task['id'] }}" name="tasks" value="{{ $task['id'] }}">
                        <label for="task-{{ $task['id'] }}">{{ $task['title'] }}</label>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Progress -->
        <div class="progress-section">
            <h3>PROGRESS</h3>
            <div class="progress-bar"></div>
            <div class="progress-label">{{ $progress }}% Complete</div>
            <div style="font-size: 12px; font-weight: bold; margin-bottom: 10px;">Leaderboard</div>
            <ul class="leaderboard">
                @foreach($leaderboard as $entry)
                    <li>{{ $entry['rank'] }}. {{ $entry['name'] }} - {{ $entry['percentage'] }}%</li>
                @endforeach
            </ul>
        </div>

        <!-- Calendar -->
        <div class="calendar-section">
            @foreach($calendarDays as $day)
                <div class="calendar-day">
                    <div class="day-label">{{ $day['date'] }} - {{ $day['label'] }}</div>
                    @foreach($day['times'] as $time)
                        <div class="day-time">{{ $time }}</div>
                    @endforeach
                    @foreach($day['tasks'] as $task)
                        <div class="task-item">
                            <span class="task-indicator indicator-{{ $task['type'] }}"></span>
                            {{ $task['title'] }}
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection