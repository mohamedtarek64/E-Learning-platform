<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorPayout extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'total_amount',
        'payment_method',
        'transaction_reference',
        'status',
        'requested_at',
        'processed_at',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'requested_at' => 'datetime',
        'processed_at' => 'datetime',
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function earnings()
    {
        return $this->hasMany(InstructorEarning::class, 'payout_id');
    }
}
