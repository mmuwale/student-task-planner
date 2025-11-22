@extends('layouts.app')

@section('title', 'Add Calendar Event')
@section('page-title', 'Add Calendar Event')
@section('content')
<div class="card" style="max-width: 500px; margin: 0 auto;">
    <h2 style="margin-bottom: 24px; color: #3d1f2e;">Add Calendar Event</h2>
    <form>
        <div style="display: flex; flex-direction: column; gap: 18px;">
            <div style="display: flex; flex-direction: column; gap: 6px;">
                <label for="event-title" style="font-weight: 600; color: #683844;">Event Title</label>
                <input type="text" id="event-title" name="title" class="form-control" style="padding: 10px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 15px;">
            </div>
            <div style="display: flex; flex-direction: column; gap: 6px;">
                <label for="event-date" style="font-weight: 600; color: #683844;">Date</label>
                <input type="date" id="event-date" name="date" class="form-control" style="padding: 10px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 15px;">
            </div>
            <button type="submit" style="margin-top: 12px; background: linear-gradient(90deg, #cc4c46ff 0%, #891d1a 100%); color: #fff; border: none; border-radius: 8px; padding: 12px 0; font-size: 16px; font-weight: 600; cursor: pointer; transition: background 0.2s;">Add Event</button>
        </div>
    </form>
</div>
@endsection
