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
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'nullable|in:pending,completed',
            'reminder_at' => 'nullable|date',
        ]);

        $task = Task::create($data);
        return response()->json($task, 201);
    }

    
    public function show(Task $task)
    {
        return $task->load('course');
    }

   
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'course_id' => 'integer|exists:courses,id',
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'nullable|in:pending,completed',
            'reminder_at' => 'nullable|date',
        ]);

        $task->update($data);
        return back()->with('status', 'Task updated.');
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

}
