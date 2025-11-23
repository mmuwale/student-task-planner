@extends('layouts.app')

@section('title', 'Completed Tasks')
@section('page_title', 'Completed Tasks')
@section('page_subtitle', 'All tasks you have finished')

@section('content')
<div class="bg-white border border-slate-200 rounded-xl shadow-sm p-5 text-xs">

    @forelse($tasks as $task)
        <div class="flex items-center justify-between border-b border-slate-100 py-2">
            <div>
                <p class="text-[13px] font-semibold text-slate-800 line-through">
                    {{ $task->title }}
                </p>
                <p class="text-[11px] text-slate-500">
                    Course: {{ $task->course->name ?? 'N/A' }}
                </p>
                <p class="text-[11px] text-slate-500">
                    Completed on: {{ $task->updated_at->format('M d, Y') }}
                </p>
            </div>
            <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 text-[10px]">
                Completed
            </span>
        </div>
    @empty
        <p class="text-slate-500 text-[12px]">No completed tasks yet.</p>
    @endforelse

</div>
@endsection
