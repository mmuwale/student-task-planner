@extends('layouts.app')

@section('title', $course->name . ' – Course')
@section('page_title', 'Course > ' . $course->name)
@section('page_subtitle', $course->instructor ? 'Instructor: '.$course->instructor : '')

@section('content')
<div x-data="{ tab: 'tasks' }" class="text-xs">

    {{-- Tabs --}}
    <div class="bg-white rounded-t-xl border border-b-0 border-slate-200">
        <div class="flex items-center gap-2 px-5 pt-4">
            <button
                @click="tab = 'tasks'"
                :class="tab === 'tasks' ? 'bg-[#800020] text-white' : 'bg-slate-100 text-slate-700'"
                class="px-3 py-1 rounded-t-md text-[11px]">
                Tasks
            </button>
            <button
                @click="tab = 'resources'"
                :class="tab === 'resources' ? 'bg-[#800020] text-white' : 'bg-slate-100 text-slate-700'"
                class="px-3 py-1 rounded-t-md text-[11px]">
                Resources
            </button>
        </div>
    </div>

    {{-- CONTENT WRAPPER --}}
    <div class="bg-white rounded-b-xl border border-slate-200 p-5">

        {{-- TASKS TAB --}}
        <div x-show="tab === 'tasks'" x-cloak>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Upcoming / remaining --}}
                <div>
                    <h3 class="text-[12px] font-semibold text-slate-800 mb-2">
                        Upcoming / Remaining
                    </h3>
                    <div class="space-y-2">
                        @forelse($upcomingTasks as $task)
                            <div class="flex items-center justify-between border border-slate-100 rounded-md px-3 py-2">
                                <div>
                                    <p class="text-[13px] text-slate-800">{{ $task->title }}</p>
                                    <p class="text-[11px] text-slate-500">
                                        Due: {{ optional($task->due_date)->format('M d, Y') ?? 'No date' }}
                                    </p>
                                </div>
                                <div class="text-right text-[11px]">
                                    <span class="px-2 py-0.5 rounded-full bg-[#fde6ee] text-[#800020] text-[10px]">
                                        {{ $task->status ?? 'To Do' }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="text-[11px] text-slate-500">No upcoming tasks for this course 🎉</p>
                        @endforelse
                    </div>
                </div>

                {{-- Completed --}}
                <div>
                    <h3 class="text-[12px] font-semibold text-slate-800 mb-2">
                        Completed
                    </h3>
                    <div class="space-y-2">
                        @forelse($completedTasks as $task)
                            <div class="flex items-center justify-between border border-slate-100 rounded-md px-3 py-2 bg-slate-50">
                                <div>
                                    <p class="text-[13px] text-slate-800 line-through">
                                        {{ $task->title }}
                                    </p>
                                    <p class="text-[11px] text-slate-500">
                                        Completed: {{ optional($task->updated_at)->format('M d, Y') }}
                                    </p>
                                </div>
                                <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 text-[10px]">
                                    Completed
                                </span>
                            </div>
                        @empty
                            <p class="text-[11px] text-slate-500">You haven’t completed any tasks yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- RESOURCES TAB --}}
        <div x-show="tab === 'resources'" x-cloak>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Upload form --}}
                <div class="md:col-span-1">
                    <h3 class="text-[12px] font-semibold text-slate-800 mb-3">Add Resource</h3>

                    @if(session('status'))
                        <div class="mb-3 text-[11px] px-3 py-2 rounded-md bg-emerald-50 text-emerald-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('courses.resources.store', $course) }}"
                          enctype="multipart/form-data" class="space-y-3 text-[11px]">
                        @csrf
                        <div>
                            <label class="block mb-1 font-semibold text-slate-700">Title</label>
                            <input type="text" name="title"
                                   class="w-full border border-[#d2aabb] rounded-md px-2 py-2 text-[12px]">
                            @error('title')<p class="text-[10px] text-red-600 mt-0.5">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold text-slate-700">File (PDF, DOC, DOCX)</label>
                            <input type="file" name="file"
                                   class="w-full border border-[#d2aabb] rounded-md px-2 py-1 text-[11px] bg-white">
                            @error('file')<p class="text-[10px] text-red-600 mt-0.5">{{ $message }}</p>@enderror
                        </div>

                        <button type="submit"
                                class="px-3 py-1.5 rounded-md bg-[#800020] text-white text-[11px] font-semibold hover:bg-[#5e0617]">
                            Upload
                        </button>
                    </form>
                </div>

                {{-- Resource list --}}
                <div class="md:col-span-2">
                    <h3 class="text-[12px] font-semibold text-slate-800 mb-3">Resources</h3>

                    <div class="space-y-2">
                        @forelse($resources as $resource)
                            <a href="{{ $resource->url }}" target="_blank"
                               class="flex items-center justify-between border border-slate-100 rounded-md px-3 py-2 hover:bg-slate-50">
                                <div>
                                    <p class="text-[13px] text-slate-800">{{ $resource->title }}</p>
                                    <p class="text-[11px] text-slate-500">
                                        {{ strtoupper(pathinfo($resource->file_path, PATHINFO_EXTENSION)) }}
                                        · added {{ $resource->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                                <span class="text-[11px] text-[#800020] font-semibold">Open ↗</span>
                            </a>
                        @empty
                            <p class="text-[11px] text-slate-500">
                                No resources yet. Upload PDFs or docs on the left.
                            </p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
