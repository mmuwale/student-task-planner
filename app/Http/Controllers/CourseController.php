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
    // Validate incoming data
    $data = $request->validate([
        'name'        => 'required|string|max:255',
        'code'        => 'nullable|string|max:50',   // from the form
        'description' => 'nullable|string',
        'color'       => 'nullable|string|max:20',
    ]);

    // Map form field `code` -> DB column `course_code`
    $course = Course::create([
        'name'         => $data['name'],
        'course_code'  => $data['code'] ?? null,      // or null if column is nullable
        'description'  => $data['description'] ?? null,
        'color'        => $data['color'] ?? null,
        'instructor_id'=> auth()->id(),// since admin = instructor
    ]);

    return redirect()
        ->route('courses.show', $course)
        ->with('status', 'Course created successfully.');
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

    public function create()
    {
        return view('courses.create');
    }
}
