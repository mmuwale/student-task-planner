<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'task_id',
        'created_by',
        'max_members',
        'status',
    ];

    protected $casts = [
        'max_members' => 'integer',
    ];

    // Relationships
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'group_members')
                    ->withPivot('role', 'joined_at')
                    ->withTimestamps();
    }

    public function groupMembers()
    {
        return $this->hasMany(GroupMember::class);
    }
}