<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CourseResource extends Model
{
    protected $fillable = ['course_id', 'title', 'file_path', 'mime_type'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getUrlAttribute()
    {
        return Storage::disk('public')->url($this->file_path);
    }
}
