<?php

use Illuminate\Support\Facades\Route;
use App\Models\Reminder;

Route::get('reminders', function () {
    $reminders = Reminder::orderByDesc('created_at')->get();
    return view('reminders.index', compact('reminders'));
})->name('reminders');
