@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Main Dashboard')
@section('page_subtitle', 'Overview of your courses and upcoming tasks')

@section('content')
<div class="space-y-6">

    {{-- TOP GRID: UPCOMING TASKS + PROGRESS --}}
    <div class="grid grid-cols-12 gap-6">
        {{-- UPCOMING TASKS (scrollable) --}}
        <div class="col-span-12 lg:col-span-7 bg-white border border-slate-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between px-5 py-3 border-b border-slate-100">
                <div class="flex items-center gap-3 text-xs">
                    <span class="font-semibold text-slate-700">Upcoming Tasks</span>
                </div>
                <a
                    href="{{ route('tasks.create') }}"
                    class="px-3 py-1.5 text-xs rounded-full bg-[#800020] text-white hover:bg-[#a22640]"
                >
                    + Add Task
                </a>
            </div>

            <div class="p-5 text-xs">
                <div class="max-h-72 overflow-y-auto">
                    @forelse($upcomingTasks as $task)
                        <div
                            class="flex items-center gap-4 py-3 border-b border-slate-100 last:border-0 hover:bg-slate-50"
                        >
                            {{-- Checkbox column (does NOT open edit) --}}
                            <div class="pl-1" @click.stop>
                                <form
                                    method="POST"
                                    action="{{ route('tasks.update', $task) }}"
                                    x-ref="completeForm{{ $task->id }}"
                                    @change="$refs.completeForm{{ $task->id }}.submit()"
                                >
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="title" value="{{ $task->title }}">
                                    <input type="hidden" name="description" value="{{ $task->description }}">
                                    <input type="hidden" name="due_date" value="{{ optional($task->due_date)->format('Y-m-d') }}">
                                    <input type="hidden" name="priority" value="{{ $task->priority }}">
                                    <input type="hidden" name="status" value="completed">

                                    <input
                                        type="checkbox"
                                        class="h-4 w-4 rounded border-slate-300 text-[#800020] focus:ring-[#800020]"
                                    >
                                </form>
                            </div>

                            {{-- Main clickable area -> EDIT VIEW --}}
                            <a
                                href="{{ route('tasks.edit', $task) }}"
                                class="flex-1 min-w-0 cursor-pointer"
                            >
                                <p class="text-[14px] font-semibold text-slate-800 truncate">
                                    {{ $task->title }}
                                </p>
                                <p class="text-[11px] text-slate-500 truncate">
                                    {{ optional($task->course)->name ?? 'No course' }} ·
                                    Due: {{ optional($task->due_date)->format('M d, Y') ?? 'No date' }}
                                </p>
                            </a>

                            {{-- Status Pill --}}
                            <div class="flex items-center">
                                <span class="px-2 py-0.5 rounded-full bg-[#fde6ee] text-[#800020] text-[10px]">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-[12px] text-slate-500">No upcoming tasks.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- PROGRESS CARD (dynamic) --}}
        <div class="col-span-12 lg:col-span-5 bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-slate-700">Progress</h2>
                <span class="text-[11px] text-slate-500">
                    {{ $progressPercent }}% complete
                </span>
            </div>
            <div class="p-4 text-xs space-y-4">
                {{-- Progress bar --}}
                <div>
                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div
                            class="h-full bg-[#800020]"
                            style="width: {{ $progressPercent }}%;"
                        ></div>
                    </div>
                    <p class="mt-2 text-[11px] text-slate-600">
                        {{ $completedTasks }} of {{ $totalTasks }} task{{ $totalTasks === 1 ? '' : 's' }} completed
                        ({{ $progressPercent }}%)
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-3 text-[11px]">
                    <div>
                        <p class="font-semibold text-slate-700 mb-1">Leaderboard</p>
                        <ul class="space-y-0.5 text-slate-600">
                            <li>1. Nathan – 78%</li>
                            <li>2. Aayla – 62%</li>
                            <li>3. Jane – 60%</li>
                            <li>4. Jerry – 58%</li>
                        </ul>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-700 mb-1">This Week</p>
                        <ul class="space-y-0.5 text-slate-600">
                            <li>✔ {{ $completedTasks }} completed</li>
                            <li>⏳ {{ max($totalTasks - $completedTasks, 0) }} remaining</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SUMMARY CARDS ROW (Today / This Week) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
        {{-- TODAY --}}
        <div class="bg-white border border-slate-200 rounded-lg p-3">
            <p class="text-[11px] text-slate-500 mb-1">Today</p>
            <p class="text-sm font-semibold text-slate-800 mb-2">
                {{ $todayTasks->count() }} task{{ $todayTasks->count() === 1 ? '' : 's' }} due
            </p>

            <div class="space-y-1 max-h-40 overflow-y-auto">
                @forelse($todayTasks as $task)
                    <a
                        href="{{ route('tasks.edit', $task) }}"
                        class="flex items-center justify-between px-2 py-1 rounded hover:bg-slate-50"
                    >
                        <div class="min-w-0">
                            <p class="text-[12px] font-semibold text-slate-800 truncate">
                                {{ $task->title }}
                            </p>
                            <p class="text-[11px] text-slate-500 truncate">
                                {{ optional($task->course)->name ?? 'No course' }}
                            </p>
                        </div>
                        <span class="text-[10px] text-slate-400">
                            {{ optional($task->due_date)->format('H:i') ?? '' }}
                        </span>
                    </a>

                    {{-- Divider (except after last item) --}}
                    @if(!$loop->last)
                        <div class="border-t border-slate-200 my-1"></div>
                    @endif
                @empty
                    <p class="text-[11px] text-slate-500">No tasks due today.</p>
                @endforelse
            </div>
        </div>

        {{-- THIS WEEK --}}
        <div class="bg-white border border-slate-200 rounded-lg p-3">
            <p class="text-[11px] text-slate-500 mb-1">This Week (next 7 days)</p>
            <p class="text-sm font-semibold text-slate-800 mb-2">
                {{ $weekTasks->count() }} upcoming task{{ $weekTasks->count() === 1 ? '' : 's' }}
            </p>

            <div class="space-y-1 max-h-40 overflow-y-auto">
                @forelse($weekTasks as $task)
                    <a
                        href="{{ route('tasks.edit', $task) }}"
                        class="flex items-center justify-between px-2 py-1 rounded hover:bg-slate-50"
                    >
                        <div class="min-w-0">
                            <p class="text-[12px] font-semibold text-slate-800 truncate">
                                {{ $task->title }}
                            </p>
                            <p class="text-[11px] text-slate-500 truncate">
                                {{ optional($task->course)->name ?? 'No course' }} ·
                                {{ optional($task->due_date)->format('D M j') }}
                            </p>
                        </div>
                    </a>

                    @if(!$loop->last)
                        <div class="border-t border-slate-200 my-1"></div>
                    @endif
                @empty
                    <p class="text-[11px] text-slate-500">No tasks due this week.</p>
                @endforelse
            </div>
        </div>

        {{-- FOCUS COURSE (placeholder) --}}
        <div class="bg-[#800020] text-white rounded-lg p-3">
            <p class="text-[11px] opacity-80 mb-1">Focus Course</p>
            <p class="text-sm font-semibold">Software Engineering</p>
        </div>
    </div>

</div>
@endsection
