<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class Courses extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $search;
    public $id, $name, $description;
    public $showForm = false;
    public $isEditing = false;

    public function render()
    {
        $query = Course::query();

        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $courses = $query->paginate(env('PAGINATION_SIZE', 10));

        return view('livewire.courses', compact('courses'));
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

   

    public function clearSearch()
    {
        $this->search = '';
    }

    public function cancel()
    {
        $this->reset();
        $this->showForm = false;
    }

    public function create()
    {
        $this->reset();
        $this->showForm = true;
        $this->isEditing = false;
    }

    public function store()
    {
        $this->validate();
        
        try {
            // Get the first user or create a demo user
            $user = User::first();
            
            if (!$user) {
                // Create a demo user if none exists
                $user = User::create([
                    'name' => 'Demo User',
                    'email' => 'demo@example.com',
                    'password' => bcrypt('password'),
                ]);
            }
            
            Course::create([
                'user_id' => $user->id,
                'name' => $this->name,
                'description' => $this->description,
                'course_code' => 'CRS' . rand(1000, 9999),
                'instructor' => 'TBA',
                'color' => '#3b82f6',
                'credit_hours' => 3,
            ]);
            
            session()->flash('success', 'Course created successfully.');
            $this->reset();
            $this->showForm = false;
            
        } catch (\Exception $e) {
            Log::error('Error creating course: ' . $e->getMessage());
            session()->flash('error', 'Failed to create course. Please try again.');
        }
    }

    public function edit($id)
    {
        $this->reset();
        $this->showForm = true;
        $this->isEditing = true;
        $course = Course::findOrFail($id);
        $this->id = $course->id;
        $this->name = $course->name;
        $this->description = $course->description;
    }

    public function update()
    {
        $this->validate();
        try {
            $course = Course::findOrFail($this->id);
            $course->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);
            session()->flash('success', 'Course updated successfully.');
            $this->reset();
            $this->showForm = false;
        } catch (\Exception $e) {
            Log::error('Error updating course: ' . $e->getMessage());
            session()->flash('error', 'Failed to update course. Please try again.');
        }
    }

    public function destroy($id)
    {
        try { 
            $course = Course::findOrFail($id);
            $course->delete();
            session()->flash('success', 'Course deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting course: ' . $e->getMessage());
            session()->flash('error', 'Course cannot be deleted');
        }
    }
}