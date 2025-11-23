<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('name')->get();
        $completedCourses = Course::where('is_completed', true)->orderBy('name')->get();

        return view('courses.index', compact('courses', 'completedCourses'));
    }

    public function store(Request $request)
    {
        return Course::create($request->all());
    }

   public function show(Course $course)
    {
        $upcomingTasks = $course->tasks()
            ->where('status', '!=', 'completed')
            ->orderBy('due_date')
            ->get();

        $completedTasks = $course->tasks()
            ->where('status', 'completed')
            ->orderByDesc('due_date')
            ->get();

        $resources = $course->resources()->latest()->get();

        $completedCourses = Course::where('is_completed', true)->orderBy('name')->get();

        return view('courses.show', compact(
            'course',
            'upcomingTasks',
            'completedTasks',
            'resources',
            'completedCourses'
        ));
    }

    public function update(Request $request, Course $course)
    {
        $course->update($request->all());
        return $course;
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
