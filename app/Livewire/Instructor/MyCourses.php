<?php

namespace App\Livewire\Instructor;

use Livewire\Component;

use App\Models\Course;
use Livewire\WithPagination;

class MyCourses extends Component
{
    use WithPagination;

    public function deleteCourse($courseId)
    {
        $course = Course::where('instructor_id', auth()->id())->findOrFail($courseId);
        $course->delete();
        session()->flash('message', 'Course deleted successfully.');
    }

    public function render()
    {
        return view('livewire.instructor.my-courses', [
            'courses' => Course::where('instructor_id', auth()->id())
                ->withCount('enrollments')
                ->latest()
                ->paginate(10)
        ])->layout('layouts.app');
    }
}
