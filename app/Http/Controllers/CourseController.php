<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Web methods (return views)
    public function index()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            // Admin view - show all courses with management options
            $courses = Course::all();
            return view('admin.courses.index', compact('courses'));
        } else {
            // Student view - show sample courses
            $courses = [
                [
                    'title' => 'Mathematics',
                    'tasks' => '5 pending tasks',
                    'color' => 'math',
                    'instructor' => 'Dr. Smith',
                ],
                [
                    'title' => 'Computer Science',
                    'tasks' => '3 pending tasks', 
                    'color' => 'cs',
                    'instructor' => 'Prof. Johnson',
                ],
                [
                    'title' => 'Physics',
                    'tasks' => '2 pending tasks',
                    'color' => 'physics',
                    'instructor' => 'Dr. Brown',
                ]
            ];
            
            return view('courses.index', compact('courses'));
        }
    }

    public function create()
    {
        // Only admin can create courses
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('admin.courses.create');
        }
        return redirect()->route('courses.index');
    }

    public function store(Request $request)
    {
        // Only admin can store courses
        if (Auth::check() && Auth::user()->role === 'admin') {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'instructor' => 'required|string|max:255',
                'credits' => 'required|integer',
            ]);

            Course::create($validated);

            return redirect()->route('courses.index')->with('success', 'Course created successfully.');
        }
        return redirect()->route('courses.index');
    }

    public function edit(Course $course)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('admin.courses.edit', compact('course'));
        }
        return redirect()->route('courses.index');
    }

    public function update(Request $request, Course $course)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'instructor' => 'required|string|max:255',
                'credits' => 'required|integer',
            ]);

            $course->update($validated);

            return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
        }
        return redirect()->route('courses.index');
    }

    public function destroy(Course $course)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $course->delete();
            return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
        }
        return redirect()->route('courses.index');
    }

    // API methods (return JSON) - for future use
    public function apiIndex()
    {
        return Course::all();
    }

    public function show(Course $course)
    {
        return $course;
    }
}
