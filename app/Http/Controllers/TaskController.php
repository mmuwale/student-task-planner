<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
{
    // GET /api/tasks
    public function index(Request $request)
{
    $q = Task::with('course')->where('status', '!=', 'completed');

    // filtering
    if ($request->filled('course_id')) {
        $q->where('course_id', $request->input('course_id'));
    }

    if ($request->filled('status')) {
        $q->where('status', $request->input('status'));
    }

    if ($request->filled('due_from')) {
        $q->where('due_date', '>=', Carbon::parse($request->input('due_from')));
    }

    if ($request->filled('due_to')) {
        $q->where('due_date', '<=', Carbon::parse($request->input('due_to')));
    }

    if ($request->boolean('upcoming')) {
        $q->whereBetween('due_date', [
            Carbon::now(),
            Carbon::now()->addDays((int) $request->input('days', 7))
        ]);
    }

    if ($request->boolean('overdue')) {
        $q->where('due_date', '<', Carbon::now())
          ->where('status', '!=', 'completed');
    }

    // sorting
    if ($request->filled('sort_by')) {
        $dir = $request->input('sort_dir', 'asc');
        $q->orderBy($request->input('sort_by'), $dir);
    } else {
        $q->orderBy('due_date', 'asc');
    }

    // decide if you want pagination or not for the VIEW
    if ($request->boolean('paginate')) {
        $perPage = max(1, (int) $request->input('per_page', env('PAGINATION_SIZE', 15)));
        $tasks = $q->paginate($perPage)->withQueryString();
    } else {
        $tasks = $q->get();
    }

    // e.g. for filters dropdown on the page
    $courses = Course::orderBy('name')->get();

    if ($request->wantsJson()) {
    return $request->boolean('paginate') ? $tasks : $tasks;
    }

    return view('tasks.index', compact('tasks', 'courses'));
}


    public function store(Request $request)
{
    $data = $request->validate([
        'course_id'       => 'nullable|integer|exists:courses,id',
        'new_course_name' => 'nullable|string|max:255',
        'title'           => 'required|string|max:255',
        'description'     => 'nullable|string',
        'due_date'        => 'required|date',
        'status'          => 'nullable|in:todo,in_progress,completed',
        'reminder_at'     => 'nullable|date',
        'priority'        => 'nullable|in:low,medium,high',
    ]);

    // If no existing course selected but user typed a name → create course
    if (empty($data['course_id']) && !empty($data['new_course_name'])) {
        $course = Course::create([
            'name' => $data['new_course_name'],
        ]);
        $data['course_id'] = $course->id;
    }

    // Still no course? Validation-style error.
    if (empty($data['course_id'])) {
        return back()
            ->withErrors(['course_id' => 'Please select or create a course.'])
            ->withInput();
    }

    // Default status if not set
    if (!isset($data['status'])) {
        $data['status'] = 'pending';
    }

    unset($data['new_course_name']); // not a column on tasks table

    $task = Task::create($data);

    // For now just redirect back – you can tweak for AJAX if needed
    if ($request->ajax() || $request->wantsJson()) {
        return response()->json($task, 201);
    }

    return redirect()->back()->with('status', 'Task created.');
}

    
    public function show(Task $task)
    {
        return $task->load('course');
    }

   
    public function update(Request $request, Task $task)
{
    $originalStatus = $task->status;

    $data = $request->validate([
        'course_id'    => 'sometimes|integer|exists:courses,id',
        'title'        => 'sometimes|string|max:255',
        'description'  => 'sometimes|nullable|string',
        'due_date'     => 'sometimes|nullable|date',
        'status'       => 'sometimes|nullable|in:todo,in_progress,completed',
        'reminder_at'  => 'sometimes|nullable|date',
    ]);

    $task->update($data);

    // If this was a normal web request and we just completed the task,
    // flash undo info to the session so the toast can use it.
    if (!$request->wantsJson()
        && $originalStatus !== 'completed'
        && $task->status === 'completed') {

        return redirect()
            ->back()
            ->with('undo_task_id', $task->id)
            ->with('undo_task_title', $task->title);
    }

    // If it's an API / AJAX request, return JSON instead of redirect
    if ($request->wantsJson()) {
        return response()->json([
            'message' => 'Task updated.',
            'task' => $task->load('course'),
        ]);
    }

    return back()->with('status', 'Task updated.');
}
    public function create()
{
    // Get courses for the dropdown
    $courses = Course::orderBy('name')->get();

    return view('tasks.create', compact('courses'));
}

    public function edit(Task $task)
    {
        // Get courses for the dropdown
        $courses = Course::orderBy('name')->get();

        return view('tasks.edit', compact('task', 'courses'));
    }


    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('status', 'Task deleted.');
    }

 
    public function clearReminder(Task $task)
    {
        $task->reminder_at = null;
        $task->reminder_sent = false;
        $task->save();
        return response()->json(['message' => 'Reminder cleared', 'task' => $task]);
    }

    public function completed()
    {
        $tasks = Task::with('course')
            ->where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('tasks.completed', compact('tasks'));
    }

    public function undoComplete(Task $task, Request $request)
{
    // You can get fancier and restore a previous status,
    // but for now we just go back to 'pending'.
    $task->update(['status' => 'todo']);

    if ($request->wantsJson()) {
        return response()->json([
            'message' => 'Task completion undone.',
            'task' => $task->load('course'),
        ]);
    }

    return redirect()
        ->back()
        ->with('status', 'Task marked as not started again.');
}


}
