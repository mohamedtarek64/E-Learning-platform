<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Public\CourseGrid;
use App\Livewire\Public\CourseShow;
use App\Livewire\Student\MyLearning;
use App\Livewire\Student\CoursePlayer;
use App\Livewire\Instructor\InstructorDashboard;
use App\Livewire\Instructor\MyCourses;
use App\Livewire\Instructor\CourseBuilder;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\ManageUsers;
use App\Livewire\Admin\ManageCourses;
use App\Http\Controllers\Instructor\DashboardController;

Route::get('/', CourseGrid::class)->name('home');
Route::get('/courses/{slug}', CourseShow::class)->name('public.course.show');

// Redirect authenticated users to Filament Admin Dashboard
Route::get('dashboard', function () {
    return redirect('/admin');
})->middleware(['auth', 'verified'])->name('dashboard');

// Student Routes
Route::middleware(['auth', 'role:student|admin'])->group(function () {
    Route::get('/my-learning', MyLearning::class)->name('student.my-learning');
    Route::get('/courses/{course}/learn', CoursePlayer::class)->name('student.course.learn');
});

// Instructor Routes - Keep Livewire for now, can migrate to Filament later
Route::middleware(['auth', 'role:instructor|admin'])->prefix('instructor')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('instructor.dashboard');
    Route::get('/courses', MyCourses::class)->name('instructor.courses');
    Route::get('/courses/create', CourseBuilder::class)->name('instructor.courses.create');
    Route::get('/courses/{course}/edit', CourseBuilder::class)->name('instructor.courses.edit');
});

// Admin Routes - Now handled by Filament at /admin
// Legacy routes commented out - use Filament Admin Panel instead
// Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
//     Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
//     Route::get('/users', ManageUsers::class)->name('admin.users');
//     Route::get('/courses', ManageCourses::class)->name('admin.courses');
// });

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
