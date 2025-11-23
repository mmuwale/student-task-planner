@extends('layouts.app')

@section('title', 'Calendar')
@section('page-title', 'Calendar')
@section('content')

<div class="card" style="width: 100%; max-width: 900px; min-height: 500px; margin: 48px auto; display: flex; flex-direction: column; justify-content: flex-start;">
@php
// Use $month, $year, $tasksByDate from controller
$firstDayOfMonth = date('N', strtotime("$year-$month-01"));
$daysInMonth = date('t', strtotime("$year-$month-01"));
$today = date('Y-m-d');
$selectedMonth = $month;
$selectedYear = $year;
// Calculate the month name for display
$currentMonthName = date('F', mktime(0, 0, 0, (int)$selectedMonth, 1, (int)$selectedYear));

// NOTE: This relies on a route named 'tasks.store' being defined


@endphp

{{-- Display the current month name and year --}}

<h2 style="margin-bottom: 24px; color: #3d1f2e;">
Calendar: {{ $currentMonthName }} {{ $selectedYear }}
</h2>

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
{{-- IMPORTANT: Added data-date for easy AJAX targeting --}}
<td data-date="{{ $date }}" style="vertical-align: top; min-width: 110px; min-height: 80px; border: 1px solid #f3e0e7; background: {{ $isToday && $isCurrentMonth ? '#ffe5e0' : ($isCurrentMonth ? '#f9f2e8' : '#f3e0e7') }}; border-radius: 8px; padding: 8px; position: relative;">
@if($isCurrentMonth)
<div style="font-weight: bold; color: #cc4c46ff;">{{ $day }}</div>
{{-- Added class for easy JavaScript selection --}}
<ul class="task-list-{{ $date }}" style="list-style: none; padding: 0; margin: 0;">
@if(isset($tasksByDate[$date]))
@foreach($tasksByDate[$date] as $task)
<li style="background: #fff; border-radius: 6px; margin-bottom: 4px; padding: 4px 6px; color: #3d1f2e; font-size: 14px; border: 1px solid #e0c3c3;">
{{ $task->title }}
@if($task->due_date)
<span style="color: #683844; font-size: 12px;">({{ \Carbon\Carbon::parse($task->due_date)->format('g:i A') }})</span>
@endif
</li>
@endforeach
@endif
</ul>
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
<!-- Add Task Modal/Form -->
<div id="addTaskModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); align-items:center; justify-content:center; z-index:1000; transition: background 0.3s;">
{{-- Form submission is now handled by JavaScript --}}
<form id="addTaskForm" style="background:#fff; border-radius:16px; padding:32px; min-width:320px; box-shadow:0 4px 32px #cc4c46aa; display:flex; flex-direction:column; gap:16px; position:relative; animation: fadeInModal 0.3s;">
@csrf
{{-- Assuming a default course_id or that it's retrieved from context --}}
<input type="hidden" name="course_id" value="1">
<input type="hidden" name="date" id="taskDateInput">
<h3 style="margin:0; color:#3d1f2e;">Add Task</h3>

    {{-- NEW: Custom Error message container to replace alert() --}}
    <div id="errorMessage" style="display:none; padding:10px; border-radius:8px; background:#ffeded; color:#891d1a; border:1px solid #ffbaba; font-size:14px;"></div>

    <label>Title:
        <input type="text" name="title" required style="width:100%; padding:8px; border-radius:6px; border:1px solid #ceb2bd;">
    </label>
    <label>Description:
        <textarea name="description" style="width:100%; padding:8px; border-radius:6px; border:1px solid #ceb2bd;"></textarea>
    </label>
    <label>Time (Optional):
        <input type="time" name="time" id="taskTimeInput" style="width:100%; padding:8px; border-radius:6px; border:1px solid #ceb2bd;">
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
// Hide error messages when showing the form
document.getElementById('errorMessage').style.display = 'none';
document.getElementById('addTaskModal').style.display = 'flex';
document.getElementById('taskDateInput').value = date;
}
function hideAddTaskForm() {
document.getElementById('addTaskModal').style.display = 'none';
document.getElementById('addTaskForm').reset(); // Clear form on close
// Also clear error messages on close
document.getElementById('errorMessage').style.display = 'none';
document.getElementById('errorMessage').innerHTML = '';
}

document.getElementById('addTaskForm').addEventListener('submit', function(e) {
e.preventDefault(); // Prevent the default form submission

const form = e.target;
const formData = new FormData(form);
const taskDate = formData.get('date');
const taskTime = formData.get('time');
const csrfToken = formData.get('_token');

// Clear any previous error messages before submission
const errorDiv = document.getElementById('errorMessage');
errorDiv.style.display = 'none';
errorDiv.innerHTML = '';

// Construct the combined due_date string (YYYY-MM-DD HH:MM:SS)
// If time is present, send the full datetime string for validation
const combinedDueDate = taskTime ? `${taskDate} ${taskTime}:00` : taskDate;

const data = {
    _token: csrfToken,
    course_id: formData.get('course_id'),
    title: formData.get('title'),
    description: formData.get('description'),
    // Send the combined date for controller validation
    due_date: combinedDueDate, 
};

// Send the AJAX request using fetch
fetch('{{ route('tasks.store') }}', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
    },
    body: JSON.stringify(data)
})
.then(response => {
    if (!response.ok) {
        // If the response status is not 2xx, process the error body
        return response.json().then(err => Promise.reject(err));
    }
    return response.json();
})
.then(data => {
    // Check for the response structure provided by the TaskController
    if (data.task && data.taskHtml) {
        // Find the correct calendar cell (td) using the data-date attribute
        const dayCell = document.querySelector(`td[data-date="${taskDate}"]`);

        if (dayCell) {
            // Find the task list using the unique class
            let taskList = dayCell.querySelector(`.task-list-${taskDate}`);
            
            // Fallback or creation if the list doesn't exist
            if (!taskList) {
                taskList = document.createElement('ul');
                taskList.className = `task-list-${taskDate}`;
                taskList.style.cssText = 'list-style: none; padding: 0; margin: 0;';
                
                // Insert the new list before the '+ Add Task' button
                const addButton = dayCell.querySelector('button');
                if(addButton) {
                    dayCell.insertBefore(taskList, addButton);
                } else {
                    dayCell.appendChild(taskList);
                }
            }
            
            // Add the new task HTML snippet (li element)
            taskList.insertAdjacentHTML('beforeend', data.taskHtml);
        }

        // Close the modal and reset the form
        hideAddTaskForm();
    } else {
        console.error('Task saved, but server response was missing HTML content.', data);
    }
})
.catch(error => {
    console.error('AJAX Error:', error);
    
    const errorDiv = document.getElementById('errorMessage');
    errorDiv.style.display = 'block';

    if (error.errors) {
        // Handle Laravel validation errors (422 Unprocessable Entity)
        let errorHtml = '<strong>Please correct the following:</strong><ul style="margin:5px 0 0; padding-left:20px; list-style-type: disc;">';
        // Iterate over all validation messages
        Object.values(error.errors).flat().forEach(msg => {
            errorHtml += `<li>${msg}</li>`;
        });
        errorHtml += '</ul>';
        errorDiv.innerHTML = errorHtml;
    } else {
        // Handle general fetch/server errors (e.g., 500 status)
        errorDiv.innerHTML = 'An unexpected server error occurred. Please check the console for details.';
    }
    
    // Removed alert()
});


});
</script>
@endsection