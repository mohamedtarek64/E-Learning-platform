<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Lesson extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'section_id',
        'title',
        'description',
        'lesson_type',
        'content',
        'video_url',
        'video_duration_seconds',
        'video_thumbnail',
        'video_size_mb',
        'is_preview',
        'sort_order',
        'resources',
        'is_published',
    ];

    protected $casts = [
        'is_preview' => 'boolean',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
        'video_duration_seconds' => 'integer',
        'video_size_mb' => 'decimal:2',
        'resources' => 'json',
    ];

    public function section()
    {
        return $this->belongsTo(CourseSection::class);
    }

    public function course()
    {
        return $this->section->course();
    }

    public function lessonResources()
    {
        return $this->hasMany(LessonResource::class);
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }

    public function completions()
    {
        return $this->hasMany(LessonCompletion::class);
    }
}
