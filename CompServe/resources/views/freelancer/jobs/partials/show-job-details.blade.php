<div>
    <h2
        class="text-lg sm:text-xl font-bold mb-4 sm:mb-6 flex items-center gap-2 bg-linear-to-r from-accent/10 to-transparent px-3 py-2 rounded-lg border-l-4 border-accent">
        <span class="text-xl sm:text-2xl">📌</span>
        <span>Job Details</span>
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">

        <!-- Type -->
        <div
            class="stat bg-linear-to-br from-primary/5 to-primary/10 rounded-xl sm:rounded-2xl p-4 sm:p-5 border-2 border-primary/20 hover:border-primary/40 transition-all duration-200 hover:shadow-lg group">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="stat-figure shrink-0">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 bg-primary/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 sm:h-6 sm:w-6 text-primary"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="stat-title text-xs sm:text-sm opacity-70 mb-1">
                        Type</div>
                    <div
                        class="stat-value text-base sm:text-lg font-bold text-primary truncate">
                        {{ $jobListing->duration_type === 'gig' ? 'Gig' : 'Contract' }}
                    </div>
                    <div
                        class="stat-desc text-xs sm:text-sm mt-0.5 flex items-center gap-1">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-primary/60"></span>
                        {{ $jobListing->duration_type === 'gig' ? 'Short-term' : 'Long-term' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Duration -->
        <div
            class="stat bg-linear-to-br from-secondary/5 to-secondary/10 rounded-xl sm:rounded-2xl p-4 sm:p-5 border-2 border-secondary/20 hover:border-secondary/40 transition-all duration-200 hover:shadow-lg group">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="stat-figure shrink-0">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 bg-secondary/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 sm:h-6 sm:w-6 text-secondary"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="stat-title text-xs sm:text-sm opacity-70 mb-1">
                        Duration</div>
                    <div
                        class="stat-value text-base sm:text-lg font-bold text-secondary truncate">
                        {{ $jobListing->duration ?? 'Flexible' }}
                    </div>
                    <div
                        class="stat-desc text-xs sm:text-sm mt-0.5 flex items-center gap-1">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-secondary/60"></span>
                        Time estimate
                    </div>
                </div>
            </div>
        </div>

        <!-- Location -->
        <div
            class="stat bg-linear-to-br from-accent/5 to-accent/10 rounded-xl sm:rounded-2xl p-4 sm:p-5 border-2 border-accent/20 hover:border-accent/40 transition-all duration-200 hover:shadow-lg group">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="stat-figure shrink-0">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 bg-accent/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 sm:h-6 sm:w-6 text-accent"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="stat-title text-xs sm:text-sm opacity-70 mb-1">
                        Location</div>
                    <div
                        class="stat-value text-base sm:text-lg font-bold text-accent truncate">
                        {{ $jobListing->location ?? 'Remote' }}
                    </div>
                    <div
                        class="stat-desc text-xs sm:text-sm mt-0.5 flex items-center gap-1">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-accent/60"></span>
                        Work location
                    </div>
                </div>
            </div>
        </div>

        <!-- Deadline -->
        <div
            class="stat bg-linear-to-br from-warning/5 to-warning/10 rounded-xl sm:rounded-2xl p-4 sm:p-5 border-2 border-warning/20 hover:border-warning/40 transition-all duration-200 hover:shadow-lg group">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="stat-figure shrink-0">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 bg-warning/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 sm:h-6 sm:w-6 text-warning"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="stat-title text-xs sm:text-sm opacity-70 mb-1">
                        Deadline</div>
                    <div
                        class="stat-value text-base sm:text-lg font-bold text-warning truncate">
                        {{ $jobListing->deadline ? $jobListing->deadline->format('M d, Y') : 'No deadline' }}
                    </div>
                    <div
                        class="stat-desc text-xs sm:text-sm mt-0.5 flex items-center gap-1">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-warning/60"></span>
                        Application deadline
                    </div>
                </div>
            </div>
        </div>

        <!-- Posted On -->
        <div
            class="stat bg-linear-to-br from-info/5 to-info/10 rounded-xl sm:rounded-2xl p-4 sm:p-5 border-2 border-info/20 hover:border-info/40 transition-all duration-200 hover:shadow-lg group">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="stat-figure shrink-0">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 bg-info/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 sm:h-6 sm:w-6 text-info"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="stat-title text-xs sm:text-sm opacity-70 mb-1">
                        Posted On</div>
                    <div
                        class="stat-value text-base sm:text-lg font-bold text-info truncate">
                        {{ $jobListing->created_at->format('M d, Y') }}
                    </div>
                    <div
                        class="stat-desc text-xs sm:text-sm mt-0.5 flex items-center gap-1">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-info/60"></span>
                        {{ $jobListing->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Last Updated -->
        <div
            class="stat bg-linear-to-br from-success/5 to-success/10 rounded-xl sm:rounded-2xl p-4 sm:p-5 border-2 border-success/20 hover:border-success/40 transition-all duration-200 hover:shadow-lg group">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="stat-figure shrink-0">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 bg-success/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 sm:h-6 sm:w-6 text-success"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="stat-title text-xs sm:text-sm opacity-70 mb-1">
                        Last Updated</div>
                    <div
                        class="stat-value text-base sm:text-lg font-bold text-success truncate">
                        {{ $jobListing->updated_at->format('M d, Y') }}
                    </div>
                    <div
                        class="stat-desc text-xs sm:text-sm mt-0.5 flex items-center gap-1">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-success/60"></span>
                        {{ $jobListing->updated_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    /* Smooth hover transitions */
    .stat {
        transition: all 0.2s ease;
    }

    .stat:hover {
        transform: translateY(-2px);
    }

    /* Icon animation */
    .stat-figure>div {
        transition: transform 0.2s ease;
    }

    /* Responsive grid adjustments */
    @media (max-width: 640px) {
        .stat {
            min-height: auto;
        }
    }
</style>
