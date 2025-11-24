<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseResourceController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root to dashboard/login
Route::get('/', function () {
    return redirect()->route('login');
});


// Breeze / auth routes (login, register, etc.)
require __DIR__.'/auth.php';

// Password verification token routes (grouped with auth)
Route::get('/verify-password', function () {
    return view('auth.verify-password');
})->name('verify-password');
Route::post('/verify-password', [App\Http\Controllers\Auth\VerifyPasswordController::class, 'submit'])->name('verify-password.submit');

// All app routes require auth
// All app routes require auth
Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |----------------------------------------------------------------------
    | Dashboard
    |----------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/dashboard/summary', [DashboardController::class, 'summary'])
        ->name('dashboard.summary');

    /*
    |----------------------------------------------------------------------
    | Profile
    |----------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*
    |----------------------------------------------------------------------
    | Tasks (this gives you tasks.create, tasks.index, etc.)
    |----------------------------------------------------------------------
    */

    // Extra task routes
    Route::get('/tasks/completed', [TaskController::class, 'completed'])
        ->name('tasks.completed');

    Route::post('/tasks/{task}/undo-complete', [TaskController::class, 'undoComplete'])
        ->name('tasks.undoComplete');

    // RESTful resource: index, create, store, show, edit, update, destroy
    Route::resource('tasks', TaskController::class);
    // => tasks.create  -> GET /tasks/create
    // => tasks.store   -> POST /tasks
    // => tasks.edit    -> GET /tasks/{task}/edit
    // etc.

    /*
    |----------------------------------------------------------------------
    | Courses (optional – if you're using them)
    |----------------------------------------------------------------------
    */

    Route::post('/courses/{course}/resources', [CourseResourceController::class, 'store'])
    ->name('courses.resources.store');

    Route::resource('courses', CourseController::class);

    // Add join/members/etc here later as needed


    /*
    |----------------------------------------------------------------------
    | Other simple pages
    |----------------------------------------------------------------------
    */
    Route::get('/projects', function () {
        return view('projects.index');
    })->name('projects');

    Route::get('/projects/create', function () {
        return view('projects.create');
    })->name('projects.create');

    Route::get('/study-group', function () {
        return view('study-group.index');
    })->name('study-group');

    Route::get('/study-group/create', function () {
        return view('study-group.create');
    })->name('study-group.create');

    Route::get('/calendar/create', function () {
        return view('calendar.create');
    })->name('calendar.create');

    Route::get('/reminders/create', function () {
        return view('reminders.create');
    })->name('reminders.create');

    Route::get('/my-projects', function () {
        return view('projects.index');
    })->name('my-projects');

    Route::get('/my-projects/create', function () {
        return view('projects.create');
    })->name('my-projects.create');

    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings');

    Route::get('/settings/create', function () {
        return view('settings.create');
    })->name('settings.create');

    /*
    |----------------------------------------------------------------------
    | Extra route files
    |----------------------------------------------------------------------
    */
    require __DIR__.'/calendar.php';
    require __DIR__.'/reminders.php';
});
