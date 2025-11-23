@extends('layouts.app')

@section('title', 'Tasks')
@section('page-title', 'Tasks')
@section('content')
<div class="card" style="width: 100%; max-width: 800px; min-height: 350px; margin: 48px auto; display: flex; flex-direction: column; justify-content: flex-start;">
    <h2 style="margin-bottom: 24px; color: #3d1f2e;">Tasks</h2>
    <form method="POST" action="#" style="margin-bottom: 32px;">
        @csrf
        <div style="display: flex; flex-direction: column; gap: 16px;">
            <div style="display: flex; flex-direction: column; gap: 6px;">
                <label for="task-title" style="font-weight: 600; color: #683844;">Task Title</label>
                <input type="text" id="task-title" name="title" class="form-control" style="padding: 10px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 15px;">
            </div>
            <div style="display: flex; flex-direction: column; gap: 6px;">
                <label for="task-desc" style="font-weight: 600; color: #683844;">Description</label>
                <textarea id="task-desc" name="description" class="form-control" style="padding: 10px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 15px; min-height: 80px;"></textarea>
            </div>
            <button type="submit" style="margin-top: 12px; background: linear-gradient(90deg, #cc4c46ff 0%, #891d1a 100%); color: #fff; border: none; border-radius: 8px; padding: 12px 0; font-size: 16px; font-weight: 600; cursor: pointer; transition: background 0.2s;">Add Task</button>
        </div>
    </form>
    <div style="margin-top: 24px; flex: 1; color: #8b6f63; text-align: center;">Your tasks will appear here.</div>
</div>
@endsection
