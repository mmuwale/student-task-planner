@extends('layouts.app')

@section('title', 'My Projects')
@section('page-title', 'My Projects')
@section('content')
<div class="card" style="width: 100%; max-width: 800px; min-height: 350px; margin: 48px auto; display: flex; flex-direction: column; justify-content: flex-start;">
    <h2 style="margin-bottom: 24px; color: #3d1f2e;">My Projects</h2>
    <div style="margin-top: 24px; flex: 1;">
        @php
            // Example: Replace with your actual projects
            $projects = [
                ['title' => 'Student Task Planner', 'status' => 'Active'],
                ['title' => 'Math Revision App', 'status' => 'Completed'],
            ];
        @endphp
        @if(count($projects))
            <ul style="list-style: none; padding: 0;">
                @foreach($projects as $project)
                    <li style="background: #f9f2e8; border-radius: 8px; margin-bottom: 12px; padding: 16px; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-weight: 600; color: #3d1f2e;">{{ $project['title'] }}</span>
                        <span style="color: #683844; font-size: 14px;">{{ $project['status'] }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <div style="color: #8b6f63; text-align: center;">No projects found.</div>
        @endif
    </div>
</div>
@endsection
