@extends('layouts.app')

@section('title', 'Create Reminder')
@section('page-title', 'Create Reminder')
@section('content')
<div class="card">
    <h2>Create Reminder</h2>
    <form>
        <!-- Add your form fields here -->
        <div class="form-group">
            <label for="reminder-title">Title</label>
            <input type="text" id="reminder-title" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="reminder-date">Date</label>
            <input type="date" id="reminder-date" name="date" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Save Reminder</button>
    </form>
</div>
@endsection
