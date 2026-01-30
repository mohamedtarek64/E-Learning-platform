<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonCompletion extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'lesson_id',
        'completed_at',
        'watch_time_seconds',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'watch_time_seconds' => 'integer',
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
