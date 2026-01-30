<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscussionReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'discussion_id',
        'user_id',
        'reply_text',
        'is_instructor_reply',
        'is_solution',
        'upvotes_count',
    ];

    protected $casts = [
        'is_instructor_reply' => 'boolean',
        'is_solution' => 'boolean',
        'upvotes_count' => 'integer',
    ];

    public function discussion()
    {
        return $this->belongsTo(CourseDiscussion::class, 'discussion_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function votes()
    {
        return $this->morphMany(DiscussionVote::class, 'voteable');
    }
}
