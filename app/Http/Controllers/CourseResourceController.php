<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseResourceController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'file'  => ['required', 'file', 'mimes:pdf,doc,docx,txt'],
        ]);

        $path = $request->file('file')->store('course-resources', 'public');

        $course->resources()->create([
            'title'     => $data['title'],
            'file_path' => $path,
            'mime_type' => $request->file('file')->getClientMimeType(),
        ]);

        return back()->with('status', 'Resource added.');
    }
}

