<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('layouts.app');
});

Route::apiResource('tasks', TaskController::class);

Route::post('tasks/{task}/clear-reminder', [TaskController::class, 'clearReminder']);


// dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/summary', [DashboardController::class, 'summary']);
Route::get('courses', [CourseController::class, 'index'])->name('courses');

Route::get('courses', function () {
    return view('courses.index');
})->name('courses');
Route::get('courses/create', function () {
    return view('courses.create');
})->name('courses.create');

Route::get('profile', function () {
    return view('profile.index');
})->name('profile');

Route::get('tasks', function () {
    return view('tasks.index');
})->name('tasks');

Route::get('tasks/create', function () {
    return view('tasks.create');
})->name('tasks.create');

Route::get('projects', function () {
    return view('projects.index');
})->name('projects');

Route::get('projects/create', function () {
    return view('projects.create');
})->name('projects.create');

Route::get('study-group', function () {
    return view('study-group.index');
})->name('study-group');

Route::get('study-group/create', function () {
    return view('study-group.create');
})->name('study-group.create');

Route::get('calendar', function () {
    return view('calendar.index');
})->name('calendar');

Route::get('calendar/create', function () {
    return view('calendar.create');
})->name('calendar.create');

Route::get('reminders', function () {
    return view('reminders.index');
})->name('reminders');

Route::get('reminders/create', function () {
    return view('reminders.create');
})->name('reminders.create');

Route::get('my-projects', function () {
    return view('projects.index');
})->name('my-projects');

Route::get('my-projects/create', function () {
    return view('projects.create');
})->name('my-projects.create');

Route::get('settings', function () {
    return view('settings.index');
})->name('settings');

Route::get('settings/create', function () {
    return view('settings.create');
})->name('settings.create');
