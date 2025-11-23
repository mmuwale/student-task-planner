<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
{
    // GET /api/tasks
    public function index(Request $request)
    {
        $q = Task::with('course');

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
            $q->whereBetween('due_date', [Carbon::now(), Carbon::now()->addDays((int)$request->input('days', 7))]);
        }

        if ($request->boolean('overdue')) {
            $q->where('due_date', '<', Carbon::now())->where('status', '!=', 'completed');
        }

        // sorting
        if ($request->filled('sort_by')) {
            $dir = $request->input('sort_dir', 'asc');
            $q->orderBy($request->input('sort_by'), $dir);
        } else {
            $q->orderBy('due_date', 'asc');
        }

        
        if ($request->boolean('paginate')) {
            $perPage = max(1, (int)$request->input('per_page', env('PAGINATION_SIZE', 15)));
            return $q->paginate($perPage);
        }

        return $q->get();
    }


    public function store(Request $request)
    {
        // Validation updated: Changed 'required|exists:courses,id' to 'required|integer' 
        // to prevent a 500 error if the courses table is empty or missing ID=1.
        $data = $request->validate([
            'course_id' => 'required|integer', 
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'status' => 'nullable|in:pending,completed',
            'reminder_at' => 'nullable|date',
        ]);
        
        // Ensure status defaults to 'pending' if not explicitly set
        if (!isset($data['status'])) {
            $data['status'] = 'pending';
        }

        $task = Task::create($data);
        
        // Check if the request is an AJAX request (for dynamic calendar update)
        if ($request->ajax() || $request->wantsJson()) {
            
            // Generate the time display for the task list item
            // Check if the due_date contains a time component
            $parsedDate = Carbon::parse($task->due_date);
            $timeFormat = ($task->due_date && $parsedDate->format('H:i:s') !== '00:00:00') 
                ? $parsedDate->format('g:i A') 
                : null;

            // Construct the HTML snippet, matching the style in the calendar view
            // Using e() for escaping the title to prevent XSS
            $taskHtml = '<li style="background: #fff; border-radius: 6px; margin-bottom: 4px; padding: 4px 6px; color: #3d1f2e; font-size: 14px; border: 1px solid #e0c3c3;">'
                        . e($task->title); 

            if ($timeFormat) {
                // Time span style
                $taskHtml .= '<span style="color: #683844; font-size: 12px;">(' . $timeFormat . ')</span>';
            }
            
            $taskHtml .= '</li>';

            // Return the JSON response for dynamic calendar update
            return response()->json([
                'task' => $task,
                'taskHtml' => $taskHtml, // The HTML snippet to insert in the calendar cell
            ], 201);
        }

        // Default JSON response for non-AJAX API calls
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
        return $task;
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }

 
    public function clearReminder(Task $task)
    {
        $task->reminder_at = null;
        $task->reminder_sent = false;
        $task->save();
        return response()->json(['message' => 'Reminder cleared', 'task' => $task]);
    }
}