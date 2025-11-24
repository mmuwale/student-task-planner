<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Courses;
use App\Models\User;
use App\Notifications\ReminderNotification;
use App\Notifications\ForgotPasswordNotification;
use App\Notifications\Studygroupnotification;
use App\Notifications\VerifypasswordNotification;
use App\Models\Task;
use App\Models\StudyGroup;

use Illuminate\Support\Facades\Mail;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::apiResource('tasks', TaskController::class);
Route::post('tasks/{task}/clear-reminder', [TaskController::class, 'clearReminder']);

// dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/summary', [DashboardController::class, 'summary']);


Route::get('/courses', Courses::class)->name('courses');



// Other unchanged routes
Route::get('profile', function () {
    return view('profile.index');
})->name('profile');

require __DIR__.'/tasks.php';

Route::get('tasks/create', function () {
    return view('tasks.create');
})->name('tasks.create');

    // Study Groups
    Route::get('study-group', function () {
        return view('study-group.index');
    })->name('study-group.index');
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
    })->name('settings.index');
    Route::get('settings/create', function () {
        return view('settings.create');
    })->name('settings.create');
    Route::post('settings', [\App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update')->middleware('auth');

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

// Test notification route (temporary)

Route::get('/test-notification', function () {
    $user = User::first();
    $task = Task::first();
    if (!$user || !$task) {
        return 'No user or task found.';
    }
    $user->notify(new ReminderNotification($task, now()->addHour()->toDateTimeString()));
    return 'Notification sent to ' . $user->email;
});

// Test all notifications (temporary)
Route::get('/test-forgot-password', function () {
    $user = User::first();
    if (!$user) return 'No user found.';
    $token = 'test-reset-token';
    $user->notify(new ForgotPasswordNotification($token));
    return 'ForgotPasswordNotification sent to ' . $user->email;
});

Route::get('/test-reminder', function () {
    $user = User::first();
    $task = Task::first();
    if (!$user || !$task) return 'No user or task found.';
    $user->notify(new ReminderNotification($task, now()->addHour()->toDateTimeString()));
    return 'ReminderNotification sent to ' . $user->email;
});

Route::get('/test-studygroup', function () {
    $user = User::first();
    $group = StudyGroup::first();
    $newMember = User::skip(1)->first() ?? $user;
    $members = User::all();
    if (!$user || !$group) return 'No user or group found.';
    $user->notify(new Studygroupnotification($group, $newMember, $members));
    return 'Studygroupnotification sent to ' . $user->email;
});

Route::get('/test-verify-password', function () {
    $user = User::first();
    if (!$user) return 'No user found.';
    $token = 'test-verify-token';
    $user->notify(new VerifypasswordNotification($token));
    return 'VerifypasswordNotification sent to ' . $user->email;
});

// Mark notification as read
Route::post('/notifications/{id}/read', function ($id) {
    $notification = auth()->user->notifications()->findOrFail($id);
    $notification->markAsRead();
    return back();
})->name('notifications.read')->middleware('auth');