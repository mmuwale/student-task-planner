<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_code',
        'name',
        'description',
        'instructor',
        'color',
        'credit_hours',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function studyGroups()
    {
        return $this->hasMany(StudyGroup::class);
    }

       public function resources()
    {
        return $this->hasMany(CourseResource::class);
    }
}