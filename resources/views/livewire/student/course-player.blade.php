<div class="h-screen flex flex-col bg-gray-900 border-t border-gray-800">
    <div class="flex-1 flex overflow-hidden">
        <!-- Video Area -->
        <div class="flex-1 flex flex-col overflow-y-auto bg-black relative">
            <!-- Header bar -->
            <div class="bg-gray-900/80 backdrop-blur-md px-6 py-4 flex items-center justify-between z-10 sticky top-0 border-b border-gray-800">
                <div class="flex items-center">
                    <a href="{{ route('student.my-learning') }}" class="mr-4 text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </a>
                    <h2 class="text-white font-bold truncate max-w-xl">{{ $currentLesson->title }}</h2>
                </div>
                <div class="flex items-center space-x-4">
                     <button wire:click="markAsComplete" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-bold hover:bg-indigo-700 transition-all flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Mark as Complete
                    </button>
                    <button class="p-2 text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Video Player Placeholder/Actual -->
            <div class="flex-1 flex items-center justify-center">
                @if($currentLesson->lesson_type === 'video')
                    <div class="w-full aspect-video bg-gray-950 flex items-center justify-center relative group">
                         <video 
                            id="video-player"
                            class="w-full h-full max-h-[70vh] shadow-2xl" 
                            controls 
                            controlsList="nodownload"
                            poster="{{ $currentLesson->video_thumbnail ? asset('storage/'.$currentLesson->video_thumbnail) : '' }}"
                        >
                            <source src="{{ $currentLesson->video_url }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-white/20 font-bold text-6xl select-none tracking-widest uppercase rotate-12">
                                PROPERTY OF {{ auth()->user()->name }}
                            </span>
                        </div>
                    </div>
                @else
                    <div class="w-full max-w-4xl mx-auto py-12 px-8 bg-white my-8 rounded-2xl shadow-2xl prose prose-indigo">
                        {!! nl2br(e($currentLesson->content)) !!}
                    </div>
                @endif
            </div>

            <!-- Tabs/Discussion Area -->
            <div class="bg-gray-900 px-8 py-12 border-t border-gray-800">
                <div class="max-w-4xl mx-auto">
                    <div class="flex space-x-8 mb-8 border-b border-gray-800">
                        <button class="pb-4 text-white border-b-2 border-indigo-500 font-bold">Overview</button>
                        <button class="pb-4 text-gray-400 hover:text-white font-bold">Q&A</button>
                        <button class="pb-4 text-gray-400 hover:text-white font-bold">Resources</button>
                        <button class="pb-4 text-gray-400 hover:text-white font-bold">Announcements</button>
                    </div>

                    <div class="text-gray-300">
                        <h3 class="text-2xl font-bold mb-4">About this lesson</h3>
                        <p class="leading-relaxed">
                            {{ $currentLesson->description ?: 'No description provided for this lesson.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-96 flex flex-col bg-gray-900 border-l border-gray-800 overflow-hidden">
            <div class="p-6 border-b border-gray-800">
                <h3 class="text-white font-bold text-lg">Course Content</h3>
                <div class="mt-2 h-2 bg-gray-800 rounded-full overflow-hidden">
                    <div class="h-full bg-indigo-600" style="width: 25%"></div>
                </div>
                <div class="mt-1 flex justify-between text-[10px] text-gray-500 font-bold uppercase tracking-wider">
                    <span>25% Complete</span>
                    <span>1/4 Lessons</span>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto">
                @foreach($course->sections as $section)
                    <div x-data="{ open: true }" class="border-b border-gray-800">
                        <button @click="open = !open" class="w-full px-6 py-4 flex items-center justify-between bg-gray-800/30 hover:bg-gray-800/50 transition-colors">
                            <span class="text-gray-300 font-bold text-sm">{{ $section->title }}</span>
                            <svg :class="{'rotate-180': open}" class="w-4 h-4 text-gray-500 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" class="bg-gray-900">
                            @foreach($section->lessons as $lesson)
                                <button 
                                    wire:click="selectLesson({{ $lesson->id }})"
                                    class="w-full px-8 py-4 flex items-start space-x-3 hover:bg-gray-800 transition-colors border-l-4 {{ $currentLessonId == $lesson->id ? 'bg-indigo-900/20 border-indigo-500 text-white' : 'border-transparent text-gray-400' }}"
                                >
                                    <div class="flex-shrink-0 mt-0.5">
                                        @if($currentLessonId == $lesson->id)
                                             <svg class="w-5 h-5 text-indigo-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                        @else
                                             <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        @endif
                                    </div>
                                    <div class="flex-1 text-left">
                                        <p class="text-sm font-medium leading-tight">{{ $lesson->title }}</p>
                                        <span class="text-[10px] text-gray-500 uppercase tracking-tighter">Video - 10:00</span>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
