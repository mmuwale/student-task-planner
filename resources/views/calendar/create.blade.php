@extends('layouts.app')

@section('title', 'Add Calendar Event')
@section('page-title', 'Add Calendar Event')
@section('content')
<div class="card">
    <h2>Add Calendar Event</h2>
    <form>
        <!-- Add your form fields here -->
        <div class="form-group">
            <label for="event-title">Event Title</label>
            <input type="text" id="event-title" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="event-date">Date</label>
            <input type="date" id="event-date" name="date" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Add Event</button>
    </form>
</div>
@endsection
