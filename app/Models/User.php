<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function studyGroups()
    {
        return $this->belongsToMany(StudyGroup::class, 'group_members')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function createdStudyGroups()
    {
        return $this->hasMany(StudyGroup::class, 'created_by');
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
    public function isAdmin():bool
    {
        return $this->role->name === 'admin';
    }
}