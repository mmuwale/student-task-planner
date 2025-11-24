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
