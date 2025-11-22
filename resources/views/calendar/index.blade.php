@extends('layouts.app')

@section('title', 'Calendar')
@section('page-title', 'Calendar')
@section('content')
<div class="card" style="width: 100%; max-width: 800px; min-height: 350px; margin: 48px auto; display: flex; flex-direction: column; justify-content: flex-start;">
    <h2 style="margin-bottom: 24px; color: #3d1f2e;">Events for Selected Day</h2>
    <form method="GET" action="" style="margin-bottom: 24px;">
        <div style="display: flex; gap: 12px; align-items: center;">
            <label for="date" style="font-weight: 600; color: #683844;">Select Date:</label>
            <input type="date" id="date" name="date" value="{{ request('date', date('Y-m-d')) }}" class="form-control" style="padding: 10px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 15px;">
            <button type="submit" style="background: linear-gradient(90deg, #cc4c46ff 0%, #891d1a 100%); color: #fff; border: none; border-radius: 8px; padding: 10px 18px; font-size: 15px; font-weight: 600; cursor: pointer; transition: background 0.2s;">Show Events</button>
        </div>
    </form>
    <div style="margin-top: 24px; flex: 1;">
        @php
            // Example: Replace this with your actual events query
            $events = [
                ['title' => 'Math Exam', 'time' => '10:00 AM'],
                ['title' => 'Group Study', 'time' => '2:00 PM'],
            ];
        @endphp
        @if(count($events))
            <ul style="list-style: none; padding: 0;">
                @foreach($events as $event)
                    <li style="background: #f9f2e8; border-radius: 8px; margin-bottom: 12px; padding: 16px; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-weight: 600; color: #3d1f2e;">{{ $event['title'] }}</span>
                        <span style="color: #683844; font-size: 14px;">{{ $event['time'] }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <div style="color: #8b6f63; text-align: center;">No events for this day.</div>
        @endif
    </div>
</div>
@endsection
