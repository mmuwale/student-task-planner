<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Mail;

// Public routes - redirect to login if not authenticated
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes (from auth.php)
require __DIR__.'/auth.php';

// Protected routes - require authentication
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/summary', [DashboardController::class, 'summary'])->name('dashboard.summary');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Courses
    Route::get('/courses', [CourseController::class, 'index'])->name('courses');
    Route::get('/courses/create', function () {
        return view('courses.create');
    })->name('courses.create');

    // Tasks
    Route::apiResource('tasks', TaskController::class);
    Route::post('tasks/{task}/clear-reminder', [TaskController::class, 'clearReminder']);
    Route::get('tasks/create', function () {
        return view('tasks.create');
    })->name('tasks.create');

    // Study Groups
    Route::get('study-group', function () {
        return view('study-group.index');
    })->name('study-group');
    Route::get('study-group/create', function () {
        return view('study-group.create');
    })->name('study-group.create');

    // Calendar
    require __DIR__.'/calendar.php';
    Route::get('calendar/create', function () {
        return view('calendar.create');
    })->name('calendar.create');

    // Reminders
    require __DIR__.'/reminders.php';
    Route::get('reminders/create', function () {
        return view('reminders.create');
    })->name('reminders.create');

    // Settings
    Route::get('settings', function () {
        return view('settings.index');
    })->name('settings');
    Route::get('settings/create', function () {
        return view('settings.create');
    })->name('settings.create');
});

// Add this to your web.php temporarily for testing
Route::get('/test-email', function () {
    try {
        Mail::raw('Test email from Student Task Planner', function ($message) {
            $message->to('test@example.com')
                    ->subject('Test Email');
        });
        return 'Email sent successfully!';
    } catch (\Exception $e) {
        return 'Email error: ' . $e->getMessage();
    }
});