<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-8 tracking-tight">Instructor Dashboard</h2>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-indigo-50 rounded-2xl">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                </div>
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-1">Total Students</h3>
                <p class="text-3xl font-extrabold text-gray-900">{{ number_format($stats['total_students']) }}</p>
                <div class="mt-2 flex items-center text-xs text-green-500 font-bold">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path></svg>
                    +12% this month
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-50 rounded-2xl">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-1">Total Courses</h3>
                <p class="text-3xl font-extrabold text-gray-900">{{ $stats['total_courses'] }}</p>
                <div class="mt-2 flex items-center text-xs text-gray-400 font-bold">
                    Active & Published
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-yellow-50 rounded-2xl">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                    </div>
                </div>
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-1">Avg Rating</h3>
                <p class="text-3xl font-extrabold text-gray-900">{{ number_format($stats['avg_rating'], 1) }}</p>
                <div class="mt-2 flex items-center text-xs text-gray-400 font-bold">
                    Based on student reviews
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-purple-50 rounded-2xl">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-1">Total Earnings</h3>
                <p class="text-3xl font-extrabold text-gray-900">${{ number_format($stats['total_earnings'], 2) }}</p>
                <div class="mt-2 flex items-center text-xs text-indigo-500 font-bold">
                    Ready for payout: $0.00
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Enrollments -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-50 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-gray-900">Recent Enrollments</h3>
                    <a href="#" class="text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-colors">View All</a>
                </div>
                <div class="p-0">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 uppercase text-[10px] font-bold text-gray-400 tracking-wider">
                                <th class="px-8 py-4">Student</th>
                                <th class="px-8 py-4">Course</th>
                                <th class="px-8 py-4">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($recentEnrollments as $enrollment)
                                <tr class="hover:bg-gray-50 transition-colors group">
                                    <td class="px-8 py-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs mr-3">
                                                {{ substr($enrollment->student->name, 0, 1) }}
                                            </div>
                                            <span class="text-sm font-semibold text-gray-700">{{ $enrollment->student->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-4">
                                        <span class="text-sm text-gray-500 truncate max-w-[150px] inline-block font-medium">{{ $enrollment->course->title }}</span>
                                    </td>
                                    <td class="px-8 py-4">
                                        <span class="text-xs text-gray-400 font-bold">{{ $enrollment->enrolled_at->diffForHumans() }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-8 py-12 text-center text-gray-400 italic">No recent enrollments.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Announcements/Quick Links -->
            <div class="space-y-8">
                <div class="bg-indigo-600 rounded-3xl p-8 text-white shadow-lg relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="text-2xl font-bold mb-2">Grow your audience</h3>
                        <p class="text-indigo-100 mb-6 max-w-sm">Create high-quality content and update your courses regularly to attract more students.</p>
                        <a href="{{ route('instructor.courses.create') }}" class="inline-flex items-center px-6 py-3 bg-white text-indigo-600 font-bold rounded-xl hover:bg-indigo-50 transition-all shadow-md active:scale-95">
                            Add New Course
                        </a>
                    </div>
                    <svg class="absolute -right-8 -bottom-8 w-48 h-48 text-indigo-500/30" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>

                <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Quick Actions</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('instructor.courses') }}" class="p-4 bg-gray-50 rounded-2xl hover:bg-gray-100 transition-colors flex flex-col items-center text-center">
                            <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-indigo-600 mb-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <span class="text-sm font-bold text-gray-700">Course List</span>
                        </a>
                         <a href="#" class="p-4 bg-gray-50 rounded-2xl hover:bg-gray-100 transition-colors flex flex-col items-center text-center">
                            <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-green-600 mb-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </div>
                            <span class="text-sm font-bold text-gray-700">Earnings</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
