<?php

namespace App\Livewire\Instructor;

use Livewire\Component;

use App\Models\Course;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class CourseBuilder extends Component
{
    use WithFileUploads;

    public $courseId;
    public $currentStep = 1;

    // Course Data
    public $title;
    public $subtitle;
    public $description;
    public $category_id;
    public $level = 'beginner';
    public $language = 'English';
    public $price = 0;
    public $thumbnail;
    public $existingThumbnail;

    public $steps = [
        1 => 'Basic Information',
        2 => 'Curriculum',
        3 => 'Pricing & Thumbnail',
        4 => 'Review & Publish'
    ];

    public $sections = [];
    public $newSectionTitle;
    public $newLessonTitles = [];

    public function mount($course = null)
    {
        if ($course) {
            $course = Course::with('sections.lessons')->findOrFail($course);
            $this->courseId = $course->id;
            $this->title = $course->title;
            $this->subtitle = $course->subtitle;
            $this->description = $course->description;
            $this->category_id = $course->category_id;
            $this->level = $course->level;
            $this->language = $course->language;
            $this->price = $course->price;
            $this->existingThumbnail = $course->thumbnail_image;
            $this->loadSections();
        }
    }

    public function loadSections()
    {
        if ($this->courseId) {
            $this->sections = \App\Models\CourseSection::where('course_id', $this->courseId)
                ->with('lessons')
                ->orderBy('sort_order')
                ->get()
                ->toArray();
        }
    }

    public function addSection()
    {
        $this->validate(['newSectionTitle' => 'required|string|max:255']);

        if (!$this->courseId) {
            $this->save(); // Save course first if it doesn't exist
        }

        \App\Models\CourseSection::create([
            'course_id' => $this->courseId,
            'title' => $this->newSectionTitle,
            'sort_order' => count($this->sections) + 1
        ]);

        $this->newSectionTitle = '';
        $this->loadSections();
    }

    public function deleteSection($sectionId)
    {
        \App\Models\CourseSection::find($sectionId)->delete();
        $this->loadSections();
    }

    public function addLesson($sectionId)
    {
        $lessonTitle = $this->newLessonTitles[$sectionId] ?? '';
        
        if (empty($lessonTitle)) {
            $this->addError('lesson_'.$sectionId, 'Lesson title is required.');
            return;
        }

        \App\Models\Lesson::create([
            'section_id' => $sectionId,
            'title' => $lessonTitle,
            'lesson_type' => 'video',
            'sort_order' => \App\Models\Lesson::where('section_id', $sectionId)->count() + 1
        ]);

        $this->newLessonTitles[$sectionId] = '';
        $this->loadSections();
    }

    public function deleteLesson($lessonId)
    {
        \App\Models\Lesson::find($lessonId)->delete();
        $this->loadSections();
    }

    public function setStep($step)
    {
        if ($step > 1 && !$this->courseId) {
            $this->save();
        }
        $this->currentStep = $step;
        if ($step == 2) {
            $this->loadSections();
        }
    }

    public function nextStep()
    {
        $this->validateStep();
        
        if (!$this->courseId) {
            $this->save();
        }

        $this->currentStep++;
        if ($this->currentStep == 2) {
            $this->loadSections();
        }
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    protected function validateStep()
    {
        if ($this->currentStep === 1) {
            $this->validate([
                'title' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'description' => 'required|string|min:50',
            ]);
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = [
            'instructor_id' => auth()->id(),
            'category_id' => $this->category_id,
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'subtitle' => $this->subtitle,
            'description' => $this->description,
            'level' => $this->level,
            'language' => $this->language,
            'price' => $this->price,
        ];

        if ($this->courseId) {
            $course = Course::find($this->courseId);
            $course->update($data);
        } else {
            $course = Course::create($data);
            $this->courseId = $course->id;
        }

        if ($this->thumbnail) {
            $path = $this->thumbnail->store('course-thumbnails', 'public');
            $course->update(['thumbnail_image' => $path]);
        }

        session()->flash('message', 'Course saved successfully.');

        if ($this->currentStep === 4) {
            return redirect()->route('instructor.courses');
        }
    }

    public function render()
    {
        return view('livewire.instructor.course-builder', [
            'categories' => Category::where('is_active', true)->whereNotNull('parent_id')->get()
        ])->layout('layouts.app');
    }
}
