<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorEarning extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'payment_id',
        'course_id',
        'amount',
        'status',
        'approved_at',
        'paid_at',
        'payout_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'approved_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function payout()
    {
        return $this->belongsTo(InstructorPayout::class, 'payout_id');
    }
}
