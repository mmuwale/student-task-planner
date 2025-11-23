@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Main Dashboard')
@section('page_subtitle', 'Overview of your courses and upcoming tasks')

@section('content')
<div
    x-data="{
        showTaskModal: false,
        showModal: false,
        activeTask: null,
        openTask(task) {
            this.activeTask = JSON.parse(JSON.stringify(task));
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        }
    }"
    class="space-y-6"
>
    {{-- TOP GRID: UPCOMING TASKS + PROGRESS --}}
    <div class="grid grid-cols-12 gap-6">
        {{-- UPCOMING TASKS (scrollable) --}}
        <div class="col-span-12 lg:col-span-7 bg-white border border-slate-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between px-5 py-3 border-b border-slate-100">
                <div class="flex items-center gap-3 text-xs">
                    <span class="font-semibold text-slate-700">Upcoming Tasks</span>
                </div>
                <button
                    @click="showTaskModal = true"
                    class="px-3 py-1.5 text-xs rounded-full bg-[#800020] text-white hover:bg-[#a22640]"
                >
                    + Add Task
                </button>
            </div>

            <div class="p-5 text-xs">
                <div class="max-h-72 overflow-y-auto">
                    @forelse($upcomingTasks as $task)
                        <div
                            class="flex items-center gap-4 py-3 border-b border-slate-100 last:border-0 cursor-pointer hover:bg-slate-50"
                            @click="openTask(@js($task))"
                        >
                            {{-- Checkbox column (does NOT open modal) --}}
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
                                    <input type="hidden" name="notes" value="{{ $task->notes }}">
                                    <input type="hidden" name="due_date" value="{{ optional($task->due_date)->format('Y-m-d') }}">
                                    <input type="hidden" name="priority" value="{{ $task->priority }}">
                                    <input type="hidden" name="status" value="completed">

                                    <input
                                        type="checkbox"
                                        class="h-4 w-4 rounded border-slate-300 text-[#800020] focus:ring-[#800020]"
                                    >
                                </form>
                            </div>

                            {{-- Main clickable area --}}
                            <div class="flex-1 min-w-0">
                                <p class="text-[14px] font-semibold text-slate-800 truncate">
                                    {{ $task->title }}
                                </p>
                                <p class="text-[11px] text-slate-500 truncate">
                                    {{ optional($task->course)->name ?? 'No course' }} ·
                                    Due: {{ optional($task->due_date)->format('M d, Y') ?? 'No date' }}
                                </p>
                            </div>

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
        <div class="bg-white border border-slate-200 rounded-lg p-3">
            <p class="text-[11px] text-slate-500 mb-1">Today</p>
            <p class="text-sm font-semibold text-slate-800">
                {{ $todayCount }} task{{ $todayCount === 1 ? '' : 's' }} due
            </p>
        </div>
        <div class="bg-white border border-slate-200 rounded-lg p-3">
            <p class="text-[11px] text-slate-500 mb-1">This Week (next 7 days)</p>
            <p class="text-sm font-semibold text-slate-800">
                {{ $weekCount }} upcoming task{{ $weekCount === 1 ? '' : 's' }}
            </p>
        </div>
        <div class="bg-[#800020] text-white rounded-lg p-3">
            <p class="text-[11px] opacity-80 mb-1">Focus Course</p>
            <p class="text-sm font-semibold">Software Engineering</p>
        </div>
    </div>

    {{-- ADD NEW TASK MODAL (existing partial) --}}
    @include('partials.add-task-modal', ['modalVar' => 'showTaskModal'])

    {{-- EDIT TASK MODAL (centered) --}}
    <div
        x-show="showModal"
        x-cloak
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
        x-transition.opacity
        @click.self="closeModal()"
    >
        <div
            class="bg-white w-full max-w-xl rounded-lg shadow-2xl p-6 relative text-slate-800"
            x-transition.scale
        >
            {{-- CLOSE BUTTON --}}
            <button
                @click="closeModal()"
                class="absolute top-2 right-3 text-slate-500 hover:text-slate-700 text-xl"
            >&times;</button>

            {{-- HEADER --}}
            <h2 class="text-lg font-semibold mb-2">
                Edit Task
            </h2>
            <p class="text-xs text-slate-500 mb-4" x-text="activeTask?.course?.name ?? 'No Course'"></p>

            {{-- EDIT FORM --}}
            <form
                method="POST"
                :action="activeTask ? '{{ url('/tasks') }}/' + activeTask.id : '#'"
                class="space-y-4 text-sm"
            >
                @csrf
                @method('PUT')

                {{-- TITLE --}}
                <div>
                    <label class="text-xs font-semibold text-slate-700">Title</label>
                    <input
                        type="text"
                        name="title"
                        class="w-full border border-slate-300 rounded-md px-3 py-2 mt-1"
                        x-model="activeTask.title"
                    >
                </div>

                {{-- NOTES --}}
                <div>
                    <label class="text-xs font-semibold text-slate-700">Notes</label>
                    <textarea
                        name="notes"
                        class="w-full border border-slate-300 rounded-md px-3 py-2 mt-1 text-xs"
                        rows="3"
                        x-model="activeTask.notes"
                    ></textarea>
                </div>

                {{-- DATE --}}
                <div>
                    <label class="text-xs font-semibold text-slate-700">Due Date</label>
                    <input
                        type="date"
                        name="due_date"
                        class="w-full border border-slate-300 rounded-md px-3 py-2 mt-1"
                        x-model="activeTask.due_date"
                    >
                </div>

                {{-- PRIORITY --}}
                <div>
                    <label class="text-xs font-semibold text-slate-700">Priority</label>
                    <select
                        name="priority"
                        class="w-full border border-slate-300 rounded-md px-3 py-2 mt-1"
                        x-model="activeTask.priority"
                    >
                        <option value="P1">P1</option>
                        <option value="P2">P2</option>
                        <option value="P3">P3</option>
                        <option value="P4">P4</option>
                    </select>
                </div>

                {{-- STATUS --}}
                <div>
                    <label class="text-xs font-semibold text-slate-700">Status</label>
                    <select
                        name="status"
                        class="w-full border border-slate-300 rounded-md px-3 py-2 mt-1"
                        x-model="activeTask.status"
                    >
                        <option value="todo">To Do</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>

                {{-- SAVE BUTTON --}}
                <div class="pt-2">
                    <button
                        type="submit"
                        class="w-full bg-[#800020] text-white py-2 rounded-md text-sm hover:bg-[#a22640]"
                    >
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
