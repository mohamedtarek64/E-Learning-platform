<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscussionVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'voteable_id',
        'voteable_type',
        'vote_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voteable()
    {
        return $this->morphTo();
    }
}
