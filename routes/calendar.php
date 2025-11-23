<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;

Route::get('calendar', function () {
    $month = request('month', date('m'));
    $year = request('year', date('Y'));
    // Get all tasks for the selected month/year
    $tasks = Task::whereYear('due_date', $year)
        ->whereMonth('due_date', $month)
        ->get();
    // Group tasks by date
    $tasksByDate = $tasks->groupBy(function($task) {
        return $task->due_date->format('Y-m-d');
    });
    return view('calendar.index', [
        'tasksByDate' => $tasksByDate,
        'month' => $month,
        'year' => $year,
    ]);
})->name('calendar');
