<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Course;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class Courses extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $orderField = "name";
    public $orderDirection = "asc";
    public $id, $name, $description;
    public $showForm = false;
    public $isEditing = false;

    public function render()
    {
        $query = Course::query();

        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $query->orderBy($this->orderField, $this->orderDirection);
        $courses = $query->paginate(env('PAGINATION_SIZE', 10));

        return view('livewire.courses', compact('courses'))
            ->extends('layouts.app')
            ->section('content');
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function orderBy($field)
    {
        if ($this->orderField === $field) {
            $this->orderDirection = $this->orderDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->orderField = $field;
            $this->orderDirection = 'asc';
        }
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
            Course::create([
                'name' => $this->name,
                'description' => $this->description,
            ]);
            session()->flash('message', 'Course created successfully.');
        } catch (QueryException $e) {
            Log::error('Error creating course: ' . $e->getMessage());
            session()->flash('error', 'Failed to create course. Please try again.');
        }
        $this->reset();
        $this->showForm = false;
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
            session()->flash('message', 'Course updated successfully.');
        } catch (QueryException $e) {
            Log::error('Error updating course: ' . $e->getMessage());
            session()->flash('error', 'Failed to update course. Please try again.');
        }
        $this->reset();
        $this->showForm = false;
    }

    public function destroy($id)
    {
        try { 
            $course = Course::findOrFail($id);
            $course->delete();
            session()->flash('success', 'Course deleted successfully');
        } catch (QueryException $e) {
            Log::error('Error deleting course: ' . $e->getMessage());
            session()->flash('error', 'Course cannot be deleted');
        }
    }
}