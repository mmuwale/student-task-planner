<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Course;
use App\Models\StudyGroup;
use App\Models\GroupMember;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $upcomingTasks = Task::where('due_date', '>=', $now)
            ->where('due_date', '<=', $now->copy()->addDays(7))
            ->orderBy('due_date', 'asc')
            ->get();

        // Build $weekDays array for daily cards
        $weekDays = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $now->copy()->addDays($i);
            $tasks = Task::whereDate('due_date', $date->toDateString())->get()->map(function($task) {
                return [
                    'title' => $task->title,
                    'color' => match($task->priority) {
                        'high' => 'red',
                        'medium' => 'blue',
                        'low' => 'green',
                        default => 'purple',
                    }
                ];
            });
            $courses = Course::whereHas('tasks', function($q) use ($date) {
                $q->whereDate('due_date', $date->toDateString());
            })->pluck('name')->toArray();
            $weekDays[] = [
                'name' => $date->format('l'),
                'date' => $date->format('M j'),
                'tasks' => $tasks,
                'courses' => $courses,
            ];
        }

        // Progress variables
        $totalTasks = Task::count();
        $completedTasks = Task::where('status', 'completed')->count();
        $completionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        // Leaderboard: users sorted by their completion rate
        $leaderboard = \App\Models\User::withCount(['tasks as completed_tasks_count' => function($q) {
                $q->where('status', 'completed');
            }, 'tasks as total_tasks_count'])
            ->get()
            ->map(function($user) {
                $rate = $user->total_tasks_count > 0 ? round(($user->completed_tasks_count / $user->total_tasks_count) * 100) : 0;
                $user->completion_rate = $rate;
                return $user;
            })->sortByDesc('completion_rate')->values();

        // Pass all variables to the dashboard view
        return view('dashboard', compact('upcomingTasks', 'weekDays', 'completionRate', 'completedTasks', 'totalTasks', 'leaderboard'));
    }
    public function summary(Request $request)
    {
        $now = Carbon::now();
        $upcomingWindowDays = (int) $request->input('upcoming_days', 7);

        $upcomingTasks = Task::whereBetween('due_date', [$now, $now->copy()->addDays($upcomingWindowDays)])->count();
        $overdueTasks = Task::where('due_date', '<', $now)->where('status', '!=', 'completed')->count();
        $totalTasks = Task::count();

        $tasksByCourse = Course::withCount(['tasks'])->get()->map(function($c){ return [
            'course_id' => $c->id,
            'course_name' => $c->name,
            'tasks_count' => $c->tasks_count
        ];});

        $studyGroupsCount = StudyGroup::count();
        $groupMembersCount = GroupMember::count();

        $todayTasks = Task::whereDate('due_date', $now->toDateString())->count();

        return response()->json([
            'total_tasks' => $totalTasks,
            'upcoming_tasks_next_days' => $upcomingTasks,
            'overdue_tasks' => $overdueTasks,
            'tasks_due_today' => $todayTasks,
            'tasks_by_course' => $tasksByCourse,
            'study_groups_count' => $studyGroupsCount,
            'group_members_count' => $groupMembersCount,
        ]);
    }
}
