<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;

Route::get('tasks', function () {
    $tasks = Task::orderByDesc('created_at')->get();
    return view('tasks.index', compact('tasks'));
})->name('tasks');
