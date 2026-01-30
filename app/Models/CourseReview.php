<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CourseReview extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'student_id',
        'course_id',
        'rating',
        'review_text',
        'is_public',
        'instructor_response',
        'responded_at',
        'helpful_count',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_public' => 'boolean',
        'responded_at' => 'datetime',
        'helpful_count' => 'integer',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['rating', 'review_text', 'is_public']);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function reports()
    {
        return $this->hasMany(ReviewReport::class, 'review_id');
    }
}
