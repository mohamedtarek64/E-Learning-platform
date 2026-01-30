<div class="bg-white min-h-screen">
    <!-- Course Header Hero -->
    <div class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <nav class="flex space-x-2 text-sm text-gray-400 font-medium">
                        <a href="{{ route('home') }}" class="hover:text-white">Courses</a>
                        <span>/</span>
                        <span class="text-indigo-400">{{ $course->category->name }}</span>
                    </nav>
                    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight leading-tight">
                        {{ $course->title }}
                    </h1>
                    <p class="text-xl text-gray-300 max-w-2xl">
                        {{ $course->subtitle }}
                    </p>
                    <div class="flex flex-wrap items-center gap-6 pt-4 text-sm font-medium">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <span class="text-white text-lg">{{ $course->average_rating ?: 'NEW' }}</span>
                            <span class="text-gray-400 ml-1">(0 reviews)</span>
                        </div>
                        <div class="text-gray-300">
                            0 Students enrolled
                        </div>
                        <div class="text-gray-300">
                            Created by <span class="text-indigo-400 cursor-pointer hover:underline">{{ $course->instructor->name }}</span>
                        </div>
                    </div>
                </div>

                <!-- Floating Purchase Card -->
                <div class="relative">
                    <div class="lg:absolute lg:-top-16 lg:right-0 w-full max-w-sm mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 z-10">
                        <div class="aspect-video relative group">
                            @if($course->thumbnail_image)
                                <img src="{{ asset('storage/'.$course->thumbnail_image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                    <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 flex items-center justify-center bg-black/40 group-hover:bg-black/20 transition-all cursor-pointer">
                                <span class="bg-white text-gray-900 rounded-full p-4 shadow-lg active:scale-95 transition-transform">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                </span>
                            </div>
                        </div>
                        <div class="p-8 text-center bg-white">
                            @if($isEnrolled)
                                <a href="{{ route('student.course.learn', $course->id) }}" class="block w-full py-4 px-6 bg-indigo-600 text-white rounded-2xl font-bold text-lg hover:bg-indigo-700 transition-all shadow-lg active:scale-95">
                                    Continue Learning
                                </a>
                            @else
                                <div class="mb-6 flex items-baseline justify-center space-x-2">
                                    <span class="text-4xl font-extrabold text-gray-900">{{ $course->price > 0 ? '$'.number_format($course->price, 2) : 'FREE' }}</span>
                                    @if($course->discounted_price)
                                        <span class="text-lg text-gray-400 line-through">${{ number_format($course->price, 2) }}</span>
                                    @endif
                                </div>
                                <button wire:click="enroll" class="w-full py-4 px-6 bg-indigo-600 text-white rounded-2xl font-bold text-lg hover:bg-indigo-700 transition-all shadow-lg active:scale-95">
                                    Enroll Now
                                </button>
                                <p class="mt-4 text-xs text-gray-400">30-Day Money-Back Guarantee (for paid courses)</p>
                            @endif
                        </div>
                        <div class="px-8 pb-8 bg-white text-left">
                            <h4 class="text-sm font-bold text-gray-900 mb-4 uppercase tracking-widest">This course includes:</h4>
                            <ul class="space-y-3 text-sm text-gray-600">
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    0 On-demand video
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Full lifetime access
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Certificate of completion
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2 space-y-12">
                <!-- What you'll learn -->
                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">What you'll learn</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if($course->learning_objectives)
                            @foreach($course->learning_objectives as $objective)
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    <span class="text-gray-600 text-sm">{{ $objective }}</span>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-500 text-sm italic">Objectives are still being updated...</p>
                        @endif
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Description</h2>
                    <div class="prose prose-indigo max-w-none text-gray-600">
                        {!! nl2br(e($course->description)) !!}
                    </div>
                </div>

                <!-- Curriculum -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Course content</h2>
                    <div class="space-y-4">
                        @foreach($course->sections as $section)
                            <div x-data="{ expanded: false }" class="border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
                                <button @click="expanded = !expanded" class="w-full bg-gray-50 px-6 py-4 flex items-center justify-between text-left hover:bg-gray-100 transition-colors">
                                    <div class="flex items-center">
                                        <svg :class="{'rotate-90': expanded}" class="w-5 h-5 mr-3 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        <h4 class="font-bold text-gray-800">{{ $section->title }}</h4>
                                    </div>
                                    <span class="text-sm text-gray-500">{{ $section->lessons->count() }} lessons</span>
                                </button>
                                <div x-show="expanded" x-collapse>
                                    <div class="bg-white px-6 py-4 space-y-4">
                                        @foreach($section->lessons as $lesson)
                                            <div class="flex items-center justify-between group">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    <span class="text-sm text-gray-600 group-hover:text-indigo-600 transition-colors cursor-pointer">{{ $lesson->title }}</span>
                                                </div>
                                                @if($lesson->is_preview)
                                                    <span class="text-xs font-bold text-indigo-600 hover:underline cursor-pointer">Preview</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Empty column for purchase card sticky positioning on larger screens -->
            <div class="hidden lg:block relative">
                <!-- Purchase card is positioned absolutely relative to its container above -->
            </div>
        </div>
    </div>
</div>
