<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'review_id',
        'reported_by',
        'reason',
        'status',
    ];

    public function review()
    {
        return $this->belongsTo(CourseReview::class, 'review_id');
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }
}
