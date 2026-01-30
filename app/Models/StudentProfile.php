<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'learning_goals',
        'interests',
        'total_courses_enrolled',
        'total_courses_completed',
        'total_certificates_earned',
    ];

    protected $casts = [
        'interests' => 'json',
        'total_courses_enrolled' => 'integer',
        'total_courses_completed' => 'integer',
        'total_certificates_earned' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
