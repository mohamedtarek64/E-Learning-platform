<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'amount',
        'original_price',
        'discount_amount',
        'currency',
        'payment_method',
        'stripe_payment_intent_id',
        'status',
        'paid_at',
        'refunded_at',
        'refund_reason',
        'instructor_share',
        'platform_fee',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'original_price' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'refunded_at' => 'datetime',
        'instructor_share' => 'decimal:2',
        'platform_fee' => 'decimal:2',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function instructorEarning()
    {
        return $this->hasOne(InstructorEarning::class);
    }
}
