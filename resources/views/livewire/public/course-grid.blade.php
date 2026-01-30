<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header & Search -->
        <div class="mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">Explore Courses</h1>
            <p class="text-lg text-gray-600 mb-8">Master new skills with our expert-led video courses.</p>
            
            <div class="flex flex-col md:flex-row gap-4 items-center">
                <div class="relative flex-1 w-full">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" wire:model.live.debounce.300ms="search" class="block w-full pl-10 pr-3 py-4 border-none bg-white shadow-sm rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all" placeholder="Search for courses, topics, or instructors...">
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <div class="w-full lg:w-64 flex-shrink-0 space-y-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-4">Categories</h3>
                    <div class="space-y-2">
                        <button wire:click="$set('selectedCategory', null)" class="w-full text-left px-3 py-2 rounded-lg text-sm {{ is_null($selectedCategory) ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                            All Categories
                        </button>
                        @foreach($categories as $category)
                            <button wire:click="$set('selectedCategory', {{ $category->id }})" class="w-full text-left px-3 py-2 rounded-lg text-sm {{ $selectedCategory == $category->id ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-4">Level</h3>
                    <div class="space-y-2">
                        @foreach(['beginner' => 'Beginner', 'intermediate' => 'Intermediate', 'advanced' => 'Advanced', 'all_levels' => 'All Levels'] as $value => $label)
                            <button wire:click="$set('selectedLevel', '{{ $value }}')" class="w-full text-left px-3 py-2 rounded-lg text-sm {{ $selectedLevel == $value ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-4">Price</h3>
                    <div class="space-y-2">
                        @foreach(['all' => 'All Prices', 'free' => 'Free', 'paid' => 'Paid'] as $value => $label)
                            <button wire:click="$set('priceRange', '{{ $value }}')" class="w-full text-left px-3 py-2 rounded-lg text-sm {{ $priceRange == $value ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Course Grid -->
            <div class="flex-1">
                @if($courses->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($courses as $course)
                            <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden transition-all duration-300 group">
                                <a href="{{ route('public.course.show', $course->slug) }}" class="block">
                                    <div class="aspect-video bg-gray-100 relative">
                                        @if($course->thumbnail_image)
                                            <img src="{{ asset('storage/'.$course->thumbnail_image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a1 1 0 011.414 0L14 15m-3-5a3 3 0 11-6 0 3 3 0 016 0zm6 2l2 2m-2-2a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            </div>
                                        @endif
                                        <div class="absolute top-2 right-2 px-2 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold text-gray-900 shadow-sm">
                                            {{ $course->price > 0 ? '$'.number_format($course->price, 2) : 'FREE' }}
                                        </div>
                                    </div>
                                    
                                    <div class="p-5">
                                        <div class="flex items-center space-x-2 mb-2">
                                            <span class="text-[10px] font-bold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded">
                                                {{ $course->category->name }}
                                            </span>
                                            <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                                {{ $course->level }}
                                            </span>
                                        </div>
                                        <h3 class="font-bold text-gray-900 text-lg mb-2 line-clamp-2 leading-tight group-hover:text-indigo-600 transition-colors">
                                            {{ $course->title }}
                                        </h3>
                                        <div class="flex items-center mb-4">
                                            <span class="text-sm text-gray-500">by {{ $course->instructor->name }}</span>
                                        </div>
                                        
                                        <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                                            <div class="flex items-center text-sm font-medium text-gray-500">
                                                <svg class="w-4 h-4 mr-1 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                {{ $course->average_rating ?: 'NEW' }}
                                            </div>
                                            <div class="text-sm text-gray-400">
                                                {{ $course->enrollments_count }} Students
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-12">
                        {{ $courses->links() }}
                    </div>
                @else
                    <div class="text-center py-24 bg-white rounded-3xl shadow-sm border border-gray-100">
                        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">No courses found</h3>
                        <p class="text-gray-500">Try adjusting your filters or search query to find what you're looking for.</p>
                        <button wire:click="$set('search', '')" class="mt-6 text-indigo-600 font-bold hover:text-indigo-700 transition-colors">Clear all filters</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
