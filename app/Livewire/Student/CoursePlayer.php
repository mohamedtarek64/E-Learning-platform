<?php

namespace App\Livewire\Student;

use Livewire\Component;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\CourseEnrollment;
use App\Models\LessonCompletion;

class CoursePlayer extends Component
{
    public $courseId;
    public $course;
    public $currentLessonId;
    public $currentLesson;

    public function mount($course)
    {
        $this->courseId = $course;
        
        // Ensure student is enrolled
        $enrollment = CourseEnrollment::where('student_id', auth()->id())
            ->where('course_id', $this->courseId)
            ->firstOrFail();

        $this->course = Course::with(['sections.lessons'])->findOrFail($this->courseId);
        
        // Start with the first lesson if none selected
        $this->currentLesson = $this->course->sections->first()->lessons->first();
        $this->currentLessonId = $this->currentLesson->id;
    }

    public function selectLesson($lessonId)
    {
        $this->currentLessonId = $lessonId;
        $this->currentLesson = Lesson::findOrFail($lessonId);
    }

    public function markAsComplete()
    {
        LessonCompletion::firstOrCreate([
            'student_id' => auth()->id(),
            'lesson_id' => $this->currentLessonId,
        ]);

        $this->dispatch('lesson-completed');
    }

    public function render()
    {
        return view('livewire.student.course-player')->layout('layouts.app');
    }
}
