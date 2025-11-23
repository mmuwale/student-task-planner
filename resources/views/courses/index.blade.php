@extends('layouts.app')


@section('title', 'My Courses')
@section('page_title', 'My Courses')

@section('page_title', 'My Courses')

@section('content')
<div style="margin: 48px auto; max-width: 950px; padding: 0 20px;">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
    <h2 style="color: #3d1f2e; margin: 0; font-size: 2rem;">My Courses</h2>
    <a href="{{ route('courses.create') }}" style="background: linear-gradient(90deg, #cc4c46ff 0%, #891d1a 100%); color: #fff; border: none; border-radius: 9px; padding: 12px 22px; font-size: 1rem; font-weight: 600; text-decoration: none; transition: background 0.2s;">+ Add New Course</a>
  </div>

  @php
  $cardColor = '#4d0011';
  $courses = [
    ['name' => 'Software Engineering', 'tasks' => 'Two Tasks remaining', 'instructor' => 'Nathan Achar'],
    ['name' => 'Discrete Math', 'tasks' => 'Six Tasks remaining', 'instructor' => 'Nathan Achar'],
    ['name' => 'Linear Algebra', 'tasks' => 'One Task remaining', 'instructor' => 'Nathan Achar'],
    ['name' => 'Differential Calculus', 'tasks' => 'No Task remaining', 'instructor' => 'Nathan Achar'],
    ['name' => 'Operating Systems', 'tasks' => 'Five Tasks remaining', 'instructor' => 'Nathan Achar'],
    ['name' => 'Principles of Ethics', 'tasks' => 'One Task remaining', 'instructor' => 'Nathan Achar'],
    ['name' => 'Maisha Program', 'tasks' => 'No Task remaining', 'instructor' => 'Nathan Achar'],
    ['name' => 'Web Application Development', 'tasks' => 'Three Tasks remaining', 'instructor' => 'Nathan Achar'],
  ];
  @endphp

  @if(count($courses))
  <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 28px;">
    @foreach($courses as $course)
    <div style="background: {{ $cardColor }}; border-radius: 10px; padding: 28px; min-height: 180px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
      <div>
        <h3 style="color: #fff; margin: 0 0 12px 0; font-size: 1.2rem;">{{ $course['name'] }}</h3>
        <div style="background: #fffcef; color: #1a1a1a; border-radius: 5px; padding: 8px 14px; display: inline-block; font-size: 0.97rem; font-weight: 600;">
          {{ $course['tasks'] }}
        </div>
      </div>
      <div style="display: flex; align-items: center; gap: 12px; margin-top: 12px;">
        <div style="width: 38px; height: 38px; background: rgba(255, 255, 255, 0.3); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
          <span style="color: #fff; font-size: 1.3rem;">👤</span>
        </div>
        <span style="color: #fff; font-size: 1rem;">{{ $course['instructor'] }}</span>
      </div>
    </div>
    @endforeach
</div>
@endsection

