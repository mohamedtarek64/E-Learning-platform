<?php

namespace App\Livewire\Student;

use Livewire\Component;

use App\Models\CourseEnrollment;

class MyLearning extends Component
{
    public function render()
    {
        $enrollments = CourseEnrollment::where('student_id', auth()->id())
            ->with(['course.instructor', 'course.category'])
            ->latest()
            ->get();

        return view('livewire.student.my-learning', [
            'enrollments' => $enrollments
        ])->layout('layouts.app');
    }
}
