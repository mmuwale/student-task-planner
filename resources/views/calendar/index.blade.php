@extends('layouts.app')

@section('title', 'Calendar')
@section('page-title', 'Calendar')
@section('content')
<div class="card" style="width: 100%; max-width: 900px; min-height: 500px; margin: 48px auto; display: flex; flex-direction: column; justify-content: flex-start;">
    <h2 style="margin-bottom: 24px; color: #3d1f2e;">Calendar</h2>
    @php
        // Use $month, $year, $tasksByDate from controller
        $firstDayOfMonth = date('N', strtotime("$year-$month-01"));
        $daysInMonth = date('t', strtotime("$year-$month-01"));
        $today = date('Y-m-d');
        $selectedMonth = $month;
        $selectedYear = $year;
    @endphp
    <form method="GET" action="" style="margin-bottom: 24px; display: flex; gap: 12px; align-items: center;">
        <label for="month" style="font-weight: 600; color: #683844;">Month:</label>
        <select name="month" id="month" style="padding: 8px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e;">
            @for($m = 1; $m <= 12; $m++)
                <option value="{{ sprintf('%02d', $m) }}" @if($month == sprintf('%02d', $m)) selected @endif>{{ date('F', mktime(0,0,0,$m,1)) }}</option>
            @endfor
        </select>
        <label for="year" style="font-weight: 600; color: #683844;">Year:</label>
        <input type="number" name="year" id="year" value="{{ $year }}" min="2020" max="2100" style="padding: 8px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; width: 90px;">
        <button type="submit" style="background: linear-gradient(90deg, #cc4c46ff 0%, #891d1a 100%); color: #fff; border: none; border-radius: 8px; padding: 8px 16px; font-size: 15px; font-weight: 600; cursor: pointer; transition: background 0.2s;">Go</button>
    </form>
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; background: #fff;">
            <thead>
                <tr style="background: #f9f2e8;">
                    <th style="padding: 10px; color: #683844;">Mon</th>
                    <th style="padding: 10px; color: #683844;">Tue</th>
                    <th style="padding: 10px; color: #683844;">Wed</th>
                    <th style="padding: 10px; color: #683844;">Thu</th>
                    <th style="padding: 10px; color: #683844;">Fri</th>
                    <th style="padding: 10px; color: #683844;">Sat</th>
                    <th style="padding: 10px; color: #683844;">Sun</th>
                </tr>
            </thead>
            <tbody>
                @php $day = 1 - ($firstDayOfMonth - 1); @endphp
                @for($week = 0; $week < 6; $week++)
                    <tr>
                        @for($d = 1; $d <= 7; $d++)
                            @php
                                $date = sprintf('%04d-%02d-%02d', $selectedYear, $selectedMonth, $day);
                                $isCurrentMonth = $day > 0 && $day <= $daysInMonth;
                                $isToday = $date == $today;
                            @endphp
                            <td style="vertical-align: top; min-width: 110px; min-height: 80px; border: 1px solid #f3e0e7; background: {{ $isToday && $isCurrentMonth ? '#ffe5e0' : ($isCurrentMonth ? '#f9f2e8' : '#f3e0e7') }}; border-radius: 8px; padding: 8px; position: relative;">
                                @if($isCurrentMonth)
                                    <div style="font-weight: bold; color: #cc4c46ff;">{{ $day }}</div>
                                    @if(isset($tasksByDate[$date]))
                                        <ul style="list-style: none; padding: 0; margin: 0;">
                                            @foreach($tasksByDate[$date] as $task)
                                                <li style="background: #fff; border-radius: 6px; margin-bottom: 4px; padding: 4px 6px; color: #3d1f2e; font-size: 14px; border: 1px solid #e0c3c3;">
                                                    {{ $task->title }}
                                                    @if($task->due_date)
                                                        <span style="color: #683844; font-size: 12px;">({{ \Carbon\Carbon::parse($task->due_date)->format('g:i A') }})</span>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <!-- Add Task Button (opens modal or inline form) -->
                                    <button onclick="showAddTaskForm('{{ $date }}')" style="margin-top: 4px; background: #cc4c46ff; color: #fff; border: none; border-radius: 6px; padding: 2px 8px; font-size: 12px; cursor: pointer;">+ Add Task</button>
                                @endif
                            </td>
                            @php $day++; @endphp
                        @endfor
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
    <!-- Add Task Modal/Form (simple version) -->
    <div id="addTaskModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:transparent; align-items:center; justify-content:center; z-index:1000; transition: background 0.3s;">
        <form method="POST" action="{{ route('tasks.store') }}" style="background:#fff; border-radius:16px; padding:32px; min-width:320px; box-shadow:0 4px 32px #cc4c46aa; display:flex; flex-direction:column; gap:16px; position:relative; animation: fadeInModal 0.3s;">
            @csrf
            <input type="hidden" name="date" id="taskDateInput">
            <h3 style="margin:0; color:#3d1f2e;">Add Task</h3>
            <label>Title:
                <input type="text" name="title" required style="width:100%; padding:8px; border-radius:6px; border:1px solid #ceb2bd;">
            </label>
            <label>Description:
                <textarea name="description" style="width:100%; padding:8px; border-radius:6px; border:1px solid #ceb2bd;"></textarea>
            </label>
            <label>Time:
                <input type="time" name="time" style="width:100%; padding:8px; border-radius:6px; border:1px solid #ceb2bd;">
            </label>
            <button type="submit" style="background: linear-gradient(90deg, #cc4c46ff 0%, #891d1a 100%); color: #fff; border: none; border-radius: 8px; padding: 10px 18px; font-size: 15px; font-weight: 600; cursor: pointer;">Save Task</button>
            <button type="button" onclick="hideAddTaskForm()" style="background: #e0c3c3; color: #683844; border: none; border-radius: 8px; padding: 8px 12px; font-size: 14px; font-weight: 600; cursor: pointer; position:absolute; top:12px; right:12px;">&times;</button>
        </form>
    </div>
    <style>
        @keyframes fadeInModal {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</div>
<script>
    function showAddTaskForm(date) {
        document.getElementById('addTaskModal').style.display = 'flex';
        document.getElementById('taskDateInput').value = date;
    }
    function hideAddTaskForm() {
        document.getElementById('addTaskModal').style.display = 'none';
    }
</script>
@endsection