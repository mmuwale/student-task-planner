@extends('layouts.app')

@section('title', 'Tasks')
@section('page_title', 'Tasks')
@section('page_subtitle', 'Inbox view of all tasks')

@section('content')
<div class="card" style="width: 100%; max-width: 800px; min-height: 350px; margin: 48px auto; display: flex; flex-direction: column; justify-content: flex-start;">
    <h2 style="margin-bottom: 24px; color: #3d1f2e;">Tasks</h2>
    {{-- $tasks is passed from the controller and contains real user tasks --}}
    <div style="margin-top: 24px; flex: 1;">
        @if(isset($tasks) && count($tasks))
            <table style="width: 100%; border-collapse: collapse; background: #f9f2e8; border-radius: 12px; overflow: hidden;">
                <thead>
                    <tr style="background: #ceb2bd; color: #2a1520;">
                        <th style="padding: 12px; text-align: left;">Title</th>
                        <th style="padding: 12px; text-align: left;">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr style="border-bottom: 1px solid #e8dcd0;">
                            <td style="padding: 12px;">{{ $task->title }}</td>
                            <td style="padding: 12px;">{{ $task->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="color: #8b6f63; text-align: center;">No tasks found.</div>
        @endif
    </div>
</div>
@endsection
