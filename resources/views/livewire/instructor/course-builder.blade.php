<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-100">
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ $courseId ? 'Edit Course' : 'Create New Course' }}
                </h2>
                <div class="flex items-center space-x-2">
                    @foreach($steps as $key => $label)
                        <div class="flex items-center">
                            <button 
                                wire:click="setStep({{ $key }})"
                                class="flex items-center justify-center w-8 h-8 rounded-full {{ $currentStep == $key ? 'bg-indigo-600 text-white' : ($currentStep > $key ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-600') }} transition-all duration-200"
                            >
                                @if($currentStep > $key)
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                @else
                                    {{ $key }}
                                @endif
                            </button>
                            @if(!$loop->last)
                                <div class="w-10 h-1 {{ $currentStep > $key ? 'bg-green-500' : 'bg-gray-200' }} mx-1"></div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            @if (session()->has('message'))
                <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-400 text-green-700">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit.prevent="save">
                <!-- Step 1: Basic Information -->
                <div class="{{ $currentStep == 1 ? 'block' : 'hidden' }} space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Course Title</label>
                        <input type="text" wire:model="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="e.g. Mastering Laravel for Beginners">
                        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Subtitle</label>
                        <input type="text" wire:model="subtitle" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="A short catchline for your course">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Category</label>
                        <select wire:model="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea wire:model="description" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Provide a detailed description of what students will learn..."></textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Level</label>
                            <select wire:model="level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                                <option value="all_levels">All Levels</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Language</label>
                            <select wire:model="language" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="English">English</option>
                                <option value="Spanish">Spanish</option>
                                <option value="French">French</option>
                                <option value="Arabic">Arabic</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Curriculum -->
                <div class="{{ $currentStep == 2 ? 'block' : 'hidden' }} space-y-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800">Course Curriculum</h3>
                        <div class="flex space-x-2">
                            <input type="text" wire:model="newSectionTitle" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="New Section Title">
                            <button type="button" wire:click="addSection" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Add Section
                            </button>
                        </div>
                    </div>
                    @error('newSectionTitle') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                    <div class="space-y-4">
                        @foreach($sections as $index => $section)
                            <div class="border border-gray-200 rounded-lg overflow-hidden bg-white shadow-sm">
                                <div class="bg-gray-50 px-4 py-3 flex items-center justify-between border-b border-gray-200">
                                    <div class="flex items-center">
                                        <span class="font-bold text-gray-400 mr-2">Section {{ $index + 1 }}:</span>
                                        <h4 class="font-semibold text-gray-700">{{ $section['title'] }}</h4>
                                    </div>
                                    <button type="button" wire:click="deleteSection({{ $section['id'] }})" class="text-red-400 hover:text-red-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v2m3 3h7"></path></svg>
                                    </button>
                                </div>
                                <div class="p-4 space-y-2">
                                    @foreach($section['lessons'] as $lesson)
                                        <div class="flex items-center justify-between bg-white border border-gray-100 p-3 rounded-md hover:bg-gray-50 transition-colors">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 text-indigo-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                <span class="text-sm text-gray-600 font-medium">{{ $lesson['title'] }}</span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <button type="button" wire:click="editLesson({{ $lesson['id'] }})" class="text-gray-400 hover:text-indigo-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </button>
                                                <button type="button" wire:click="deleteLesson({{ $lesson['id'] }})" class="text-gray-400 hover:text-red-500">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="mt-4 flex space-x-2">
                                        <input type="text" wire:model="newLessonTitles.{{ $section['id'] }}" class="flex-1 rounded-md border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-300 sm:text-xs" placeholder="New Lesson Title">
                                        <button type="button" wire:click="addLesson({{ $section['id'] }})" class="inline-flex items-center px-3 py-1 border border-indigo-600 text-xs font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50">
                                            Add Lesson
                                        </button>
                                    </div>
                                    @error('lesson_'.$section['id']) <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if(count($sections) === 0)
                        <div class="bg-gray-50 border border-dashed border-gray-300 rounded-lg p-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No sections yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Start by adding a section title above.</p>
                        </div>
                    @endif
                </div>

                <!-- Step 3: Pricing & Thumbnail -->
                <div class="{{ $currentStep == 3 ? 'block' : 'hidden' }} space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-800">Pricing</h3>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="number" wire:model="price" step="0.01" class="block w-full rounded-md border-gray-300 pl-7 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="0.00">
                            </div>
                            <p class="text-sm text-gray-500 italic">Set to 0.00 for a free course.</p>
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-800">Course Thumbnail</h3>
                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                    @if($thumbnail)
                                        <img src="{{ $thumbnail->temporaryUrl() }}" class="h-full w-full object-cover rounded-lg">
                                    @elseif($existingThumbnail)
                                        <img src="{{ asset('storage/'.$existingThumbnail) }}" class="h-full w-full object-cover rounded-lg">
                                    @else
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 font-semibold">Click to upload</p>
                                            <p class="text-xs text-gray-500">PNG, JPG or WEBP (MAX. 1MB)</p>
                                        </div>
                                    @endif
                                    <input id="dropzone-file" type="file" wire:model="thumbnail" class="hidden" />
                                </label>
                            </div>
                            @error('thumbnail') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Step 4: Review & Publish -->
                <div class="{{ $currentStep == 4 ? 'block' : 'hidden' }} space-y-6 text-center py-12">
                    <div class="bg-indigo-50 p-8 rounded-xl max-w-2xl mx-auto shadow-inner">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">You're almost there!</h3>
                        <p class="text-gray-600 mb-8 leading-relaxed">
                            Your course is ready to be published. Students will be able to discover and enroll in your course.
                            Please review all details before final publication.
                        </p>
                        <div class="flex flex-col items-center justify-center space-y-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Title and description completed
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Pricing set to ${{ number_format($price, 2) }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="mt-12 flex justify-between border-t border-gray-100 pt-6">
                    @if($currentStep > 1)
                        <button 
                            type="button" 
                            wire:click="previousStep"
                            class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Back
                        </button>
                    @else
                        <div></div>
                    @endif

                    <div class="flex space-x-3">
                        <button 
                            type="button" 
                            wire:click="save"
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Save Draft
                        </button>

                        @if($currentStep < 4)
                            <button 
                                type="button" 
                                wire:click="nextStep"
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Next Step
                            </button>
                        @else
                            <button 
                                type="submit"
                                class="inline-flex items-center px-10 py-3 border border-transparent text-base font-bold rounded-lg shadow-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 animate-pulse"
                            >
                                Publish Course
                            </button>
                        @endif
                    </div>
                </div>
            </form>
            <!-- Lesson Edit Modal -->
            @if($editingLessonId)
                <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Edit Lesson</h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Lesson Title</label>
                                        <input type="text" wire:model="editingLessonTitle" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @error('editingLessonTitle') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Video URL (MP4)</label>
                                        <input type="text" wire:model="editingLessonVideoUrl" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="https://example.com/video.mp4">
                                        @error('editingLessonVideoUrl') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Description</label>
                                        <textarea wire:model="editingLessonDescription" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" wire:model="editingLessonIsPreview" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                        <label class="ml-2 block text-sm text-gray-900">Allow free preview</label>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="button" wire:click="updateLesson" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Save Changes
                                </button>
                                <button type="button" wire:click="cancelEdit" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
