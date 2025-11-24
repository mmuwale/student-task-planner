<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseResourceController;
use App\Http\Controllers\ProfileController;

// Existing routes
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/summary', [DashboardController::class, 'summary']);
Route::get('courses', [CourseController::class, 'index'])->name('courses');


require __DIR__.'/tasks.php';

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

require __DIR__.'/calendar.php';

Route::get('calendar/create', function () {
    return view('calendar.create');
})->name('calendar.create');

require __DIR__.'/reminders.php';

Route::get('reminders/create', function () {
    return view('reminders.create');
})->name('reminders.create');
require __DIR__.'/reminders.php';

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


// better routes
Route::get('/courses/{course}', [CourseController::class, 'show'])
     ->name('courses.show');

Route::resource('courses', CourseController::class);

Route::post('/courses/{course}/resources', [CourseResourceController::class, 'store'])
    ->name('courses.resources.store');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/tasks/completed', [TaskController::class, 'completed'])
    ->name('tasks.completed');


Route::resource('tasks', TaskController::class);


Route::post('/tasks/{task}/undo-complete', [TaskController::class, 'undoComplete'])
    ->name('tasks.undoComplete');