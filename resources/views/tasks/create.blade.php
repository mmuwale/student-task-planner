@extends('layouts.app')

@section('title', 'Add Task')
@section('page_title', 'Add New Task')
@section('page_subtitle', 'Create a new task')

@section('content')
<div class="max-w-md mx-auto bg-white border border-slate-200 rounded-lg shadow-sm p-5 text-xs">
    <h2 class="text-sm font-semibold text-slate-800 mb-3">Add New Task</h2>

    <form method="POST" action="{{ route('tasks.store') }}" class="space-y-3">
        @csrf

        {{-- TITLE --}}
        <div>
            <label class="block mb-1 font-semibold text-[11px] text-slate-700">Task Name</label>
            <input type="text" name="title" required
                   class="w-full border border-slate-300 rounded-md px-3 py-2 text-[12px]">
        </div>

        {{-- COURSE + DUE DATE --}}
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block mb-1 font-semibold text-[11px] text-slate-700">Course</label>
                <select name="course_id" required
                        class="w-full border border-slate-300 rounded-md px-2 py-2 text-[12px]">
                    <option value="">Select Course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-1 font-semibold text-[11px] text-slate-700">Due Date</label>
                <input type="date" name="due_date" required
                       class="w-full border border-slate-300 rounded-md px-2 py-2 text-[12px]">
            </div>
        </div>

        {{-- PRIORITY + STATUS --}}
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block mb-1 font-semibold text-[11px] text-slate-700">Priority</label>
                <select name="priority"
                        class="w-full border border-slate-300 rounded-md px-2 py-2 text-[12px]">
                    <option value="low">Low</option>
                    <option value="medium" selected>Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
            <div>
                <label class="block mb-1 font-semibold text-[11px] text-slate-700">Status</label>
                <select name="status"
                        class="w-full border border-slate-300 rounded-md px-2 py-2 text-[12px]">
                    <option value="todo" selected>To Do</option>
                    <option value="in_progress">In Progress</option>
                </select>
            </div>
        </div>

        {{-- NOTES -> description --}}
        <div>
            <label class="block mb-1 font-semibold text-[11px] text-slate-700">Notes</label>
            <textarea name="description" rows="2"
                      class="w-full border border-slate-300 rounded-md px-3 py-2 text-[12px]"></textarea>
        </div>

        <div class="flex justify-end gap-2 pt-2">
            <a href="{{ route('tasks.index') }}"
               class="px-3 py-1.5 rounded-md border border-slate-300 text-[11px] text-slate-700 hover:bg-slate-50">
                Cancel
            </a>
            <button type="submit"
                    class="px-3 py-1.5 rounded-md bg-[#800020] text-white text-[11px] font-semibold hover:bg-[#5e0617]">
                Add Task
            </button>
        </div>
    </form>
</div>
@endsection
