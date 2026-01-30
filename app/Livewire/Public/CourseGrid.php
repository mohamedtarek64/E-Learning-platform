<?php

namespace App\Livewire\Public;

use Livewire\Component;

use App\Models\Course;
use App\Models\Category;
use Livewire\WithPagination;

class CourseGrid extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = null;
    public $selectedLevel = null;
    public $priceRange = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => null],
        'selectedLevel' => ['except' => null],
        'priceRange' => ['except' => 'all'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Course::where('is_published', true)
            ->with(['instructor', 'category'])
            ->withCount('enrollments');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('subtitle', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        if ($this->selectedLevel) {
            $query->where('level', $this->selectedLevel);
        }

        if ($this->priceRange === 'free') {
            $query->where('price', 0);
        } elseif ($this->priceRange === 'paid') {
            $query->where('price', '>', 0);
        }

        return view('livewire.public.course-grid', [
            'courses' => $query->latest()->paginate(12),
            'categories' => Category::where('is_active', true)->whereNotNull('parent_id')->get()
        ])->layout('layouts.app');
    }
}
