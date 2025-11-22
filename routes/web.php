<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('layouts.app');
});

Route::apiResource('tasks', TaskController::class);

Route::post('tasks/{task}/clear-reminder', [TaskController::class, 'clearReminder']);


// dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/summary', [DashboardController::class, 'summary']);
Route::get('courses', function () {
    return view('pages.courses');
})->name('courses');

Route::get('profile', function () {
    return view('profile');
})->name('profile');

Route::get('tasks', function () {
    return view('pages.tasks');
})->name('tasks');