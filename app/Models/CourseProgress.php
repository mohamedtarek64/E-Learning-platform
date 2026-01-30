<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseProgress extends Model
{
    use HasFactory;

    protected $table = 'course_progress';

    protected $fillable = [
        'enrollment_id',
        'total_lessons',
        'completed_lessons',
        'total_quizzes',
        'passed_quizzes',
        'progress_percentage',
        'current_lesson_id',
    ];

    protected $casts = [
        'total_lessons' => 'integer',
        'completed_lessons' => 'integer',
        'total_quizzes' => 'integer',
        'passed_quizzes' => 'integer',
        'progress_percentage' => 'decimal:2',
    ];

    public function enrollment()
    {
        return $this->belongsTo(CourseEnrollment::class, 'enrollment_id');
    }

    public function currentLesson()
    {
        return $this->belongsTo(Lesson::class, 'current_lesson_id');
    }
}
