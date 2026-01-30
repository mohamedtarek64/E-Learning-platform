<?php

namespace App\Livewire\Instructor;

use Livewire\Component;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\InstructorProfile;
use Illuminate\Support\Facades\DB;

class InstructorDashboard extends Component
{
    public function render()
    {
        $instructorId = auth()->id();
        
        $stats = [
            'total_students' => CourseEnrollment::whereIn('course_id', function($query) use ($instructorId) {
                $query->select('id')->from('courses')->where('instructor_id', $instructorId);
            })->count(),
            
            'total_courses' => Course::where('instructor_id', $instructorId)->count(),
            
            'avg_rating' => Course::where('instructor_id', $instructorId)->avg('average_rating') ?: 0,
            
            'total_earnings' => auth()->user()->instructorProfile->total_earnings ?? 0,
        ];

        $recentEnrollments = CourseEnrollment::whereIn('course_id', function($query) use ($instructorId) {
                $query->select('id')->from('courses')->where('instructor_id', $instructorId);
            })
            ->with(['student', 'course'])
            ->latest()
            ->limit(5)
            ->get();

        return view('livewire.instructor.instructor-dashboard', [
            'stats' => $stats,
            'recentEnrollments' => $recentEnrollments
        ])->layout('layouts.app');
    }
}
