<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoWatchLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'lesson_id',
        'watch_duration_seconds',
        'completed_percentage',
        'watched_at',
    ];

    protected $casts = [
        'watch_duration_seconds' => 'integer',
        'completed_percentage' => 'decimal:2',
        'watched_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
