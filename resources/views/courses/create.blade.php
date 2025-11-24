@extends('layouts.app')

@section('title', 'Create Course')
@section('page_title', 'Create New Course')
@section('page_subtitle', 'Add a new course to your instructor dashboard')

@section('content')
<div class="max-w-xl mx-auto bg-white border border-slate-200 rounded-xl shadow-sm p-6 text-sm">

    {{-- HEADER --}}
    <div class="mb-4">
        <h2 class="text-lg font-semibold text-slate-800">New Course</h2>
        <p class="text-xs text-slate-500">Fill in the details to create a new course.</p>
    </div>

    {{-- ERROR HANDLING --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-3 py-2 rounded-md text-xs">
            <strong class="block mb-1">Please fix the following:</strong>
            <ul class="list-disc ml-4 space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- CREATE FORM --}}
    <form method="POST" action="{{ route('courses.store') }}" class="space-y-4">
        @csrf

        {{-- Course Name --}}
        <div>
            <label class="block mb-1 font-semibold text-[12px] text-slate-700">
                Course Name
            </label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                class="w-full border border-slate-300 rounded-md px-3 py-2 text-xs focus:ring-[#800020]/60 focus:border-[#800020]"
                placeholder="e.g. Software Engineering"
            >
        </div>

        {{-- Course Code --}}
        <div>
            <label class="block mb-1 font-semibold text-[12px] text-slate-700">
                Course Code (Optional)
            </label>
            <input
                type="text"
                name="code"
                value="{{ old('code') }}"
                class="w-full border border-slate-300 rounded-md px-3 py-2 text-xs focus:ring-[#800020]/60 focus:border-[#800020]"
                placeholder="e.g. SE-202"
            >
        </div>

        {{-- Description --}}
        <div>
            <label class="block mb-1 font-semibold text-[12px] text-slate-700">
                Description
            </label>
            <textarea
                name="description"
                rows="3"
                class="w-full border border-slate-300 rounded-md px-3 py-2 text-xs focus:ring-[#800020]/60 focus:border-[#800020]"
                placeholder="Brief description of the course..."
            >{{ old('description') }}</textarea>
        </div>

        {{-- Color Tag --}}
        <div>
            <label class="block mb-1 font-semibold text-[12px] text-slate-700">
                Course Color Tag (Optional)
            </label>

            <select
                name="color"
                class="w-full border border-slate-300 rounded-md px-3 py-2 text-xs focus:ring-[#800020]/60 focus:border-[#800020]"
            >
                <option value="">None</option>
                <option value="red">Red</option>
                <option value="blue">Blue</option>
                <option value="green">Green</option>
                <option value="purple">Purple</option>
                <option value="yellow">Yellow</option>
                <option value="pink">Pink</option>
            </select>
        </div>

        {{-- SUBMIT ACTIONS --}}
        <div class="flex justify-end gap-2 pt-2">
            <a
                href="{{ route('courses.index') }}"
                class="px-3 py-1.5 rounded-md border border-slate-300 text-[11px] text-slate-700 hover:bg-slate-100"
            >
                Cancel
            </a>
            <button
                type="submit"
                class="px-4 py-1.5 rounded-md bg-[#800020] text-white text-[11px] font-semibold hover:bg-[#a22640]"
            >
                Create Course
            </button>
        </div>

    </form>
</div>
@endsection
