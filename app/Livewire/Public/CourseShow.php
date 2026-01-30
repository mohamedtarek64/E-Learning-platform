<?php

namespace App\Livewire\Public;

use Livewire\Component;

use App\Models\Course;
use App\Models\CourseEnrollment;

class CourseShow extends Component
{
    public $slug;
    public $course;
    public $isEnrolled = false;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->course = Course::where('slug', $slug)
            ->where('is_published', true)
            ->with(['instructor', 'category', 'sections.lessons'])
            ->firstOrFail();

        if (auth()->check()) {
            $this->isEnrolled = CourseEnrollment::where('student_id', auth()->id())
                ->where('course_id', $this->course->id)
                ->exists();
        }
    }

    public function enroll()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if ($this->course->price > 0) {
            // Future: Redirect to Checkout
            session()->flash('error', 'Paid enrollment is coming soon.');
            return;
        }

        CourseEnrollment::firstOrCreate([
            'student_id' => auth()->id(),
            'course_id' => $this->course->id,
            'enrollment_type' => 'free',
        ]);

        $this->isEnrolled = true;
        session()->flash('message', 'Successfully enrolled in the course!');
        return redirect()->route('student.course.learn', $this->course->id);
    }

    public function render()
    {
        return view('livewire.public.course-show')->layout('layouts.app');
    }
}
