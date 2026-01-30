<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ApplyToBecomeInstructor extends Component
{
    public $bio;
    public $experience;
    public $submitted = false;

    public function mount()
    {
        $user = Auth::user();
        if ($user->instructor_status !== 'none' && $user->instructor_status !== 'rejected') {
            $this->submitted = true;
        }
    }

    public function submit()
    {
        $this->validate([
            'bio' => 'required|string|min:100',
            'experience' => 'required|string|min:50',
        ]);

        $user = Auth::user();
        $user->update([
            'instructor_status' => 'pending',
            'bio' => $this->bio,
        ]);

        $this->submitted = true;
        session()->flash('message', 'Application submitted successfully! Our team will review it soon.');
    }

    public function render()
    {
        return view('livewire.instructor.apply-to-become-instructor')
            ->layout('layouts.app');
    }
}
