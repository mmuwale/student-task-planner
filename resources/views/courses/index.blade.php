@extends('layouts.app')

@section('title', 'My Courses')
@section('page_title', 'My Courses')

@section('content')
<div class="grid grid-cols-3 gap-4 text-xs">
    @foreach($courses as $course)
        <a href="{{ route('courses.show', $course) }}"
           class="block rounded-lg shadow-sm border border-slate-200 bg-white hover:shadow-md transition overflow-hidden">
            <div class="px-4 py-3 bg-[#800020] text-white text-[11px]">
                {{ $course->name }}
            </div>
            <div class="p-3 space-y-1">
                <p class="text-[11px] text-slate-500">Instructor: {{ $course->instructor }}</p>
                <p class="text-[11px] text-slate-500">Next: Lab due Friday</p>
                <div class="mt-2 flex items-center justify-between">
                    <div class="h-1.5 w-24 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full w-2/3 bg-[#800020]"></div>
                    </div>
                    <span class="text-[10px] text-slate-500">67% complete</span>
                </div>
            </div>
        </a>
    @endforeach
</div>
@endsection
