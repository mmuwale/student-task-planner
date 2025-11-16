<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'title',
        'description',
        'due_date',
        'due_time',
        'priority',
        'status',
        'estimated_duration',
        'actual_duration',
        'progress',
        'is_recurring',
        'recurring_pattern',
        'type',
    ];

    protected $casts = [
        'due_date' => 'date',
        'is_recurring' => 'boolean',
        'progress' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function studyGroup()
    {
        return $this->hasOne(StudyGroup::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
}