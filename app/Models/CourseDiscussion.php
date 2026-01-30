<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDiscussion extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'lesson_id',
        'title',
        'question_text',
        'is_resolved',
        'upvotes_count',
    ];

    protected $casts = [
        'is_resolved' => 'boolean',
        'upvotes_count' => 'integer',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function replies()
    {
        return $this->hasMany(DiscussionReply::class, 'discussion_id');
    }

    public function votes()
    {
        return $this->morphMany(DiscussionVote::class, 'voteable');
    }
}
