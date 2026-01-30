<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <div class="md:flex">
                <div class="md:w-1/3 bg-indigo-600 p-12 text-white flex flex-col justify-center">
                    <h2 class="text-3xl font-extrabold mb-6">Teach the world</h2>
                    <p class="text-indigo-100 text-lg mb-8">Share your knowledge and inspire students worldwide. Join our community of expert instructors today.</p>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg class="h-6 w-6 text-indigo-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Reach millions of students</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-6 w-6 text-indigo-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Earn money on every enrollment</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-6 w-6 text-indigo-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Flexible platform & tools</span>
                        </li>
                    </ul>
                </div>
                
                <div class="md:w-2/3 p-12">
                    @if($submitted)
                        <div class="text-center py-12">
                            <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Application Received!</h3>
                            <p class="text-gray-600 mb-8">Thank you for your interest. Your application is currently under review by our team.</p>
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 transition">
                                Go to Dashboard
                            </a>
                        </div>
                    @else
                        <h3 class="text-2xl font-bold text-gray-900 mb-8">Instructor Application</h3>
                        
                        <form wire:submit.prevent="submit" class="space-y-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Biological Information / About You</label>
                                <textarea wire:model="bio" rows="4" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition" placeholder="Tell us about yourself and your background..."></textarea>
                                @error('bio') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Teaching Experience</label>
                                <textarea wire:model="experience" rows="4" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition" placeholder="Describe your previous teaching or professional experience..."></textarea>
                                @error('experience') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-sm text-lg font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition transform hover:-translate-y-0.5">
                                    Submit Application
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
