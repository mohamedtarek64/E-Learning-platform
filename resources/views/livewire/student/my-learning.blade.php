<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-8 tracking-tight">My Learning</h2>

        @if($enrollments->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($enrollments as $enrollment)
                    <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                        <div class="aspect-video relative">
                            @if($enrollment->course->thumbnail_image)
                                <img src="{{ asset('storage/'.$enrollment->course->thumbnail_image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('student.course.learn', $enrollment->course->id) }}" class="p-3 bg-white rounded-full text-indigo-600 shadow-lg transform scale-90 group-hover:scale-100 transition-transform">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                </a>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded uppercase tracking-widest">{{ $enrollment->course->category->name }}</span>
                                <span class="text-xs text-gray-400">Enrolled: {{ $enrollment->enrolled_at->format('M d, Y') }}</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-lg mb-4 line-clamp-2 leading-tight min-h-[3.5rem] group-hover:text-indigo-600 transition-colors">
                                {{ $enrollment->course->title }}
                            </h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <div class="flex justify-between text-xs font-bold text-gray-500 mb-2">
                                        <span>Progress</span>
                                        <span>{{ number_format($enrollment->progress_percentage, 0) }}%</span>
                                    </div>
                                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-indigo-500 transition-all duration-1000" style="width: {{ $enrollment->progress_percentage }}%"></div>
                                    </div>
                                </div>
                                <a href="{{ route('student.course.learn', $enrollment->course->id) }}" class="block w-full py-3 text-center bg-gray-900 text-white rounded-xl font-bold text-sm hover:bg-gray-800 transition-colors shadow-lg active:scale-95">
                                    Continue Learning
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-24 bg-white rounded-3xl shadow-sm border border-gray-100 max-w-2xl mx-auto">
                <div class="w-24 h-24 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">No courses yet</h3>
                <p class="text-gray-500 mb-8 px-8">You haven't enrolled in any courses yet. Start your learning journey today!</p>
                <a href="{{ route('home') }}" class="inline-flex items-center px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-all shadow-lg active:scale-95">
                    Browse Courses
                </a>
            </div>
        @endif
    </div>
</div>
