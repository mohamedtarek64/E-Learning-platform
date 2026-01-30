<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'headline',
        'biography',
        'expertise_areas',
        'website_url',
        'twitter',
        'linkedin',
        'github',
        'total_students',
        'total_courses',
        'average_rating',
        'total_earnings',
        'payout_method',
        'payout_details',
    ];

    protected $casts = [
        'expertise_areas' => 'json',
        'total_students' => 'integer',
        'total_courses' => 'integer',
        'average_rating' => 'decimal:2',
        'total_earnings' => 'decimal:2',
        'payout_details' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
