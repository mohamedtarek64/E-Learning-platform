<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Course extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'instructor_id',
        'category_id',
        'title',
        'slug',
        'subtitle',
        'description',
        'learning_objectives',
        'requirements',
        'target_audience',
        'level',
        'language',
        'thumbnail_image',
        'promo_video_url',
        'price',
        'discounted_price',
        'discount_expires_at',
        'currency',
        'is_published',
        'published_at',
        'is_featured',
        'status',
        'total_duration_minutes',
        'total_lectures_count',
        'total_quizzes_count',
        'total_students',
        'average_rating',
        'total_reviews_count',
        'last_updated_at',
    ];

    protected $casts = [
        'learning_objectives' => 'json',
        'requirements' => 'json',
        'price' => 'decimal:2',
        'discounted_price' => 'decimal:2',
        'discount_expires_at' => 'datetime',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'total_duration_minutes' => 'integer',
        'total_lectures_count' => 'integer',
        'total_quizzes_count' => 'integer',
        'total_students' => 'integer',
        'average_rating' => 'decimal:2',
        'total_reviews_count' => 'integer',
        'last_updated_at' => 'datetime',
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sections()
    {
        return $this->hasMany(CourseSection::class)->orderBy('sort_order');
    }

    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, CourseSection::class, 'course_id', 'section_id');
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function reviews()
    {
        return $this->hasMany(CourseReview::class);
    }

    public function discussions()
    {
        return $this->hasMany(CourseDiscussion::class);
    }

    public function announcements()
    {
        return $this->hasMany(CourseAnnouncement::class);
    }
}
