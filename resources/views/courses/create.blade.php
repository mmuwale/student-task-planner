@extends('layouts.app')

@section('title', 'My Courses')

@section('content')
<div class="page-content">
    <div class="page-title">My Courses</div>
    <div class="courses-grid">
        @foreach($courses as $course)
            <div class="course-card {{ $course['color'] }}">
                <div>
                    <div class="course-title">{{ $course['title'] }}</div>
                    <div class="course-tasks">{{ $course['tasks'] }}</div>
                </div>
                <div class="course-instructor">
                    <div class="instructor-avatar" style="background-image: url('{{ $course['avatar'] }}'); background-size: cover;"></div>
                    <span>{{ $course['instructor'] }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection