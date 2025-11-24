@extends('layouts.app')

@section('title', 'Edit Task')
@section('page_title', 'Edit Task')
@section('page_subtitle', 'Modify task details')

@section('content')
<div class="max-w-lg mx-auto bg-white border border-slate-200 rounded-lg shadow p-6 text-xs">

    {{-- HEADER --}}
    <div class="mb-4">
        <h2 class="text-lg font-semibold text-slate-800">Edit Task</h2>
        <p class="text-[11px] text-slate-500">{{ optional($task->course)->name ?? 'No Course Assigned' }}</p>
    </div>

    {{-- FORM --}}
    <form method="POST" action="{{ route('tasks.update', $task) }}" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- TITLE --}}
        <div>
            <label class="block mb-1 font-semibold text-[11px] text-slate-700">Task Name</label>
            <input type="text" name="title" required
                   value="{{ old('title', $task->title) }}"
                   class="w-full border border-slate-300 rounded-md px-3 py-2 text-[12px] focus:ring-2 focus:ring-[#800020]/60">
        </div>

        {{-- COURSE + DUE DATE --}}
        <div class="grid grid-cols-2 gap-4">
            {{-- COURSE --}}
            <div>
                <label class="block mb-1 font-semibold text-[11px] text-slate-700">Course</label>
                <select name="course_id"
                        class="w-full border border-slate-300 rounded-md px-2 py-2 text-[12px]">
                    <option value="">Unassigned</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}"
                                @selected(old('course_id', $task->course_id) == $course->id)>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- DUE DATE --}}
            <div>
                <label class="block mb-1 font-semibold text-[11px] text-slate-700">Due Date</label>
                <input type="date" name="due_date"
                       value="{{ old('due_date', optional($task->due_date)->format('Y-m-d')) }}"
                       class="w-full border border-slate-300 rounded-md px-2 py-2 text-[12px]">
            </div>
        </div>

        {{-- PRIORITY + STATUS --}}
        <div class="grid grid-cols-2 gap-4">
            {{-- PRIORITY --}}
            <div>
                <label class="block mb-1 font-semibold text-[11px] text-slate-700">Priority</label>
                <select name="priority"
                        class="w-full border border-slate-300 rounded-md px-2 py-2 text-[12px]">
                    <option value="low" @selected($task->priority === 'low')>Low</option>
                    <option value="medium" @selected($task->priority === 'medium')>Medium</option>
                    <option value="high" @selected($task->priority === 'high')>High</option>
                </select>
            </div>

            {{-- STATUS --}}
            <div>
                <label class="block mb-1 font-semibold text-[11px] text-slate-700">Status</label>
                <select name="status"
                        class="w-full border border-slate-300 rounded-md px-2 py-2 text-[12px]">
                    <option value="todo" @selected($task->status === 'todo')>To Do</option>
                    <option value="in_progress" @selected($task->status === 'in_progress')>In Progress</option>
                    <option value="completed" @selected($task->status === 'completed')>Completed</option>
                </select>
            </div>
        </div>

        {{-- NOTES --}}
        <div>
            <label class="block mb-1 font-semibold text-[11px] text-slate-700">Notes</label>
            <textarea name="description" rows="3"
                      class="w-full border border-slate-300 rounded-md px-3 py-2 text-[12px]">{{ old('description', $task->description) }}</textarea>
        </div>

        {{-- BUTTONS --}}
        <div class="flex justify-between pt-2">
            <a href="{{ route('tasks.index') }}"
               class="px-3 py-1.5 rounded-md border border-slate-300 text-[11px] text-slate-700 hover:bg-slate-50">
                Back
            </a>

            <button type="submit"
                    class="px-3 py-1.5 rounded-md bg-[#800020] text-white text-[11px] font-semibold hover:bg-[#5e0617]">
                Save Changes
            </button>
        </div>
    </form>

</div>
@endsection
