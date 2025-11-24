<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Mail;

// Public routes
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Authentication routes
require __DIR__.'/auth.php';

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/summary', [DashboardController::class, 'summary'])->name('dashboard.summary');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tasks - Add named route for tasks index
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::apiResource('tasks', TaskController::class);
    Route::post('tasks/{task}/clear-reminder', [TaskController::class, 'clearReminder'])->name('tasks.clear-reminder');
    Route::get('tasks/create', function () {
        return view('tasks.create');
    })->name('tasks.create');
    require __DIR__.'/tasks.php';

    // Courses - Available to all authenticated users
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

    // Study Groups
    Route::get('study-group', function () {
        return view('study-group.index');
    })->name('study-group.index');
    Route::get('study-group/create', function () {
        return view('study-group.create');
    })->name('study-group.create');

    // Calendar - Add named route for calendar
    Route::get('calendar', function () {
        return view('calendar.index');
    })->name('calendar');
    require __DIR__.'/calendar.php';
    Route::get('calendar/create', function () {
        return view('calendar.create');
    })->name('calendar.create');

    // Reminders - Add named route for reminders
    Route::get('reminders', function () {
        return view('reminders.index');
    })->name('reminders');
    require __DIR__.'/reminders.php';
    Route::get('reminders/create', function () {
        return view('reminders.create');
    })->name('reminders.create');

    // Settings
    Route::get('settings', function () {
        return view('settings.index');
    })->name('settings.index');
    Route::get('settings/create', function () {
        return view('settings.create');
    })->name('settings.create');
});

// Admin-only routes - Using the middleware class directly
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    // User Management
    Route::prefix('admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });

    // Course Management (Admin only)
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
});

// Test email route (temporary)
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
