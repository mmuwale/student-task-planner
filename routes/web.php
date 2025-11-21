<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('tasks', TaskController::class);

Route::post('tasks/{task}/clear-reminder', [TaskController::class, 'clearReminder']);


// dashboard
Route::get('dashboard/summary', [DashboardController::class, 'summary']);
