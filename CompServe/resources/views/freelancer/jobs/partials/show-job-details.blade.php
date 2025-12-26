<h2 class="text-xl font-bold mb-4 flex items-center gap-2">
    <span class="text-2xl">📌</span>
    Job Details
</h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <div class="stat bg-base-200 rounded-lg">
        <div class="stat-figure text-primary">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div class="stat-title text-xs">Type</div>
        <div class="stat-value text-base">
            {{ $jobListing->duration_type === 'gig' ? 'Gig' : 'Contract' }}
        </div>
        <div class="stat-desc text-xs">
            {{ $jobListing->duration_type === 'gig' ? 'Short-term' : 'Long-term' }}
        </div>
    </div>

    <div class="stat bg-base-200 rounded-lg">
        <div class="stat-figure text-secondary">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
        <div class="stat-title text-xs">Duration</div>
        <div class="stat-value text-base">
            {{ $jobListing->duration ?? 'Flexible' }}</div>
        <div class="stat-desc text-xs">Time estimate</div>
    </div>

    <div class="stat bg-base-200 rounded-lg">
        <div class="stat-figure text-accent">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8"
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
        <div class="stat-title text-xs">Location</div>
        <div class="stat-value text-base">
            {{ $jobListing->location ?? 'Remote' }}</div>
        <div class="stat-desc text-xs">Work location</div>
    </div>

    <div class="stat bg-base-200 rounded-lg">
        <div class="stat-figure text-warning">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div class="stat-title text-xs">Deadline</div>
        <div class="stat-value text-base">
            {{ $jobListing->deadline ? $jobListing->deadline->format('M d, Y') : 'No deadline' }}
        </div>
        <div class="stat-desc text-xs">Application deadline
        </div>
    </div>

    <div class="stat bg-base-200 rounded-lg">
        <div class="stat-figure text-info">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
        <div class="stat-title text-xs">Posted On</div>
        <div class="stat-value text-base">
            {{ $jobListing->created_at->format('M d, Y') }}
        </div>
        <div class="stat-desc text-xs">
            {{ $jobListing->created_at->diffForHumans() }}
        </div>
    </div>

    <div class="stat bg-base-200 rounded-lg">
        <div class="stat-figure text-success">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
        </div>
        <div class="stat-title text-xs">Last Updated</div>
        <div class="stat-value text-base">
            {{ $jobListing->updated_at->format('M d, Y') }}
        </div>
        <div class="stat-desc text-xs">
            {{ $jobListing->updated_at->diffForHumans() }}
        </div>
    </div>
</div>
