@extends('layouts.app')

@section('title', 'Tasks')
@section('page_title', 'Tasks')
@section('page_subtitle', 'Inbox view of all tasks')

@section('content')
<div
    class="col-span-12 lg:col-span-7 bg-white border border-slate-200 rounded-xl shadow-sm mx-auto mt-10 relative"
    x-data="{ toastOpen: true }"
>
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-3 border-b border-slate-100">
        <div class="flex items-center gap-3 text-xs">
            <span class="font-semibold text-slate-700">All Tasks</span>
            <span class="text-[11px] text-slate-500">Grouped by course</span>
        </div>

        <a
            href="{{ route('tasks.create') }}"
            class="px-3 py-1.5 text-xs rounded-full bg-[#800020] text-white hover:bg-[#a22640]"
        >
            + Add Task
        </a>
    </div>

    <div class="p-5 text-xs">
        @if($tasks->count())
            @php
                // Group tasks by course name (or "Unassigned" if no course)
                $tasksByCourse = $tasks->groupBy(function ($task) {
                    return optional($task->course)->name ?? 'Unassigned';
                });
            @endphp

            <div class="max-h-72 overflow-y-auto space-y-4">
                @foreach($tasksByCourse as $courseName => $courseTasks)
                    {{-- Course heading --}}
                    <dpv>
                        <h3 class="text-[13px] font-semibold text-slate-700 mb-1">
                            {{ $courseName }}
                        </h3>

                        <div class="border border-slate-100 rounded-lg divide-y divide-slate-100">
                            @foreach($courseTasks as $task)
                                <div class="flex items-center gap-4 py-2.5 px-3 bg-white hover:bg-slate-50">
                                    {{-- Checkbox column --}}
                                    <div class="pl-1">
                                        <form
                                            method="POST"
                                            action="{{ route('tasks.update', $task) }}"
                                        >
                                            @csrf
                                            @method('PUT')

                                            {{-- keep all current values, only change status --}}
                                            <input type="hidden" name="title" value="{{ $task->title }}">
                                            <input type="hidden" name="description" value="{{ $task->description }}">
                                            <input type="hidden" name="due_date" value="{{ optional($task->due_date)->format('Y-m-d') }}">
                                            <input type="hidden" name="status" value="completed">

                                            <input
                                                type="checkbox"
                                                class="h-4 w-4 rounded border-slate-300 text-[#800020] focus:ring-[#800020]"
                                                onchange="this.form.submit()"
                                            >
                                        </form>
                                    </div>

                                    {{-- Main clickable area (goes to edit page) --}}
                                    <a
                                        href="{{ route('tasks.edit', $task) }}"
                                        class="flex-1 min-w-0 cursor-pointer"
                                    >
                                        <p class="text-[14px] font-semibold text-slate-800 truncate">
                                            {{ $task->title }}
                                        </p>
                                        <p class="text-[11px] text-slate-500 truncate">
                                            Due: {{ optional($task->due_date)->format('M d, Y') ?? 'No date' }}
                                        </p>
                                    </a>

                                    {{-- Status pill --}}
                                    <div class="flex items-center">
                                        <span class="px-2 py-0.5 rounded-full bg-[#fde6ee] text-[#800020] text-[10px]">
                                            {{ ucfirst($task->status ?? 'pending') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </dpv>
                @endforeach
            </div>
        @else
            <p class="text-[12px] text-slate-500">No tasks found.</p>
        @endif
    </div>

    {{-- GLOBAL UNDO TOAST (bottom-right, detached from list) --}}
    @if(session('undo_task_id'))
        <div
            x-show="toastOpen"
            x-transition.opacity
            x-init="setTimeout(() => toastOpen = false, 15000)" {{-- 15 seconds --}}
            class="fixed bottom-4 right-4 z-50 max-w-xs bg-[#111827] text-white text-xs px-4 py-3 rounded-lg shadow-xl flex items-start gap-3"
        >
            <div class="flex-1">
                <p class="font-semibold text-[13px]">Task completed</p>
                <p class="text-[11px] text-slate-200">
                    “{{ session('undo_task_title') }}” was marked as completed.
                </p>
            </div>

            <form
                method="POST"
                action="{{ route('tasks.undoComplete', session('undo_task_id')) }}"
                class="flex items-center"
            >
                @csrf
                <button
                    type="submit"
                    class="text-[11px] font-semibold underline decoration-[#f9a8d4] decoration-2 underline-offset-2 mr-2"
                >
                    Undo
                </button>
            </form>

            <button
                class="text-[13px] text-slate-300 hover:text-white"
                @click="toastOpen = false"
            >
                &times;
            </button>
        </div>
    @endif
</div>
@endsection
