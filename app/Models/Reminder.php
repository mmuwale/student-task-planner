<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'remindable_type',
        'remindable_id',
        'type',
        'message',
        'scheduled_for',
        'is_sent',
        'sent_at',
    ];

    protected $casts = [
        'scheduled_for' => 'datetime',
        'sent_at' => 'datetime',
        'is_sent' => 'boolean',
    ];

    // Polymorphic relationship
    public function remindable()
    {
        return $this->morphTo();
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}