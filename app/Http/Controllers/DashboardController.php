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
        // You can customize the view name as needed
        return view('dashboard');
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
