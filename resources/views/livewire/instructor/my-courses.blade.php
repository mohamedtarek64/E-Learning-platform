<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">My Courses</h2>
            <a href="{{ route('instructor.courses.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:scale-105">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Create New Course
            </a>
        </div>

        @if (session()->has('message'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 text-green-700 rounded-md shadow-sm">
                {{ session('message') }}
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6">
            @forelse($courses as $course)
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 rounded-2xl border border-gray-100 p-6 flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6">
                    <div class="w-full md:w-48 h-32 flex-shrink-0 bg-gray-100 rounded-xl overflow-hidden relative group">
                        @if($course->thumbnail_image)
                            <img src="{{ asset('storage/'.$course->thumbnail_image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a1 1 0 011.414 0L14 15m-3-5a3 3 0 11-6 0 3 3 0 016 0zm6 2l2 2m-2-2a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                    </div>

                    <div class="flex-1 space-y-2 text-center md:text-left">
                        <div class="flex items-center justify-center md:justify-start space-x-2">
                             <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $course->is_published ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $course->is_published ? 'Published' : 'Draft' }}
                            </span>
                            <span class="text-xs text-gray-400 uppercase font-bold">{{ $course->level }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 hover:text-indigo-600 transition-colors cursor-pointer">
                            {{ $course->title }}
                        </h3>
                        <p class="text-gray-500 text-sm line-clamp-2 max-w-2xl">
                            {{ $course->subtitle ?: 'No subtitle provided.' }}
                        </p>
                        <div class="flex items-center justify-center md:justify-start space-x-6 pt-2 text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                {{ $course->enrollments_count }} Students
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                {{ $course->average_rating ?: 'No ratings' }}
                            </div>
                            <div class="font-bold text-gray-900 bg-gray-50 px-3 py-1 rounded-lg">
                                {{ $course->price > 0 ? '$'.number_format($course->price, 2) : 'Free' }}
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-row md:flex-col space-x-2 md:space-x-0 md:space-y-2 w-full md:w-auto">
                        <a href="{{ route('instructor.courses.edit', $course) }}" class="flex-1 md:w-28 text-center px-4 py-2 border border-gray-200 text-sm font-semibold rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                            Edit
                        </a>
                        <button onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="deleteCourse({{ $course->id }})" class="flex-1 md:w-28 text-center px-4 py-2 border border-transparent text-sm font-semibold rounded-lg text-red-600 bg-red-50 hover:bg-red-100 transition-colors">
                            Delete
                        </button>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-24 h-24 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-4 text-indigo-200">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">No courses yet</h3>
                    <p class="text-gray-500 mb-8">Share your knowledge with the world. Create your first course today!</p>
                    <a href="{{ route('instructor.courses.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-all">
                        Get Started
                    </a>
                </div>
            @endforelse

            <div class="mt-6">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</div>
