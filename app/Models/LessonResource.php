<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'title',
        'file_path',
        'file_type',
        'file_size_kb',
        'download_count',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
