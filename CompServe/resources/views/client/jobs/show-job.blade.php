<x-layouts.app>
    <!-- Breadcrumbs with enhanced styling -->
    <div class="breadcrumbs text-sm mb-6">
        <ul class="text-base-content/60">
            <li><a href="{{ route('dashboard') }}"
                    class="hover:text-primary transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a></li>
            @if ($jobListing->duration_type === 'gig')
                <li><a href="{{ route('client.gigs.index') }}"
                        class="hover:text-primary transition-colors">All
                        Gigs</a></li>
            @elseif($jobListing->duration_type === 'contract')
                <li><a href="{{ route('client.contracts.index') }}"
                        class="hover:text-primary transition-colors">All
                        Contracts</a></li>
            @endif
            <li class="text-primary font-semibold">{{ $jobListing->title }}</li>
        </ul>
    </div>

    {{-- Success Message --}}
    @session('success')
        <div class="mb-6 animate-fade-in">
            <div role="alert"
                class="alert alert-success shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 shrink-0"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endsession

    <div class="max-w-6xl mx-auto space-y-6">

        {{-- Main Job Card --}}
        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body">

                {{-- Header Section --}}
                <div
                    class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 pb-6 border-b border-base-300">
                    <div class="flex-1">
                        <div class="flex items-start gap-3">
                            <div class="avatar avatar-placeholder">
                                <div
                                    class="bg-primary text-primary-content rounded-lg w-12 h-12">
                                    <span class="text-xl">📝</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h1
                                    class="text-3xl font-bold text-base-content mb-2">
                                    {{ $jobListing->title }}</h1>
                                <div
                                    class="flex flex-wrap gap-2 items-center text-sm">
                                    <div
                                        class="badge badge-lg badge-ghost gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        {{ Str::headline($jobListing->category) }}
                                    </div>
                                    @php
                                        $statusColors = [
                                            'open' => 'badge-success',
                                            'in_progress' => 'badge-warning',
                                            'completed' => 'badge-accent',
                                            'cancelled' => 'badge-error',
                                        ];
                                        $statusEmoji = [
                                            'open' => '🟢',
                                            'available' => '🟢',
                                            'in_progress' => '⏳',
                                            'pending' => '🕒',
                                            'completed' => '✅',
                                            'cancelled' => '❌',
                                            'on_hold' => '⏸️',
                                            'rejected' => '🚫',
                                        ];
                                    @endphp
                                    <div
                                        class="badge badge-lg {{ $statusColors[$jobListing->status] ?? 'badge-ghost' }} gap-2">
                                        {{ $statusEmoji[$jobListing->status] ?? '📌' }}
                                        {{ ucfirst(str_replace('_', ' ', $jobListing->status)) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <div class="stat bg-primary/10 rounded-lg px-6 py-4">
                            <div class="stat-title text-xs opacity-70">Budget
                            </div>
                            <div class="stat-value text-primary text-2xl">
                                ₱{{ number_format($jobListing->budget, 2) }}
                            </div>
                            <div class="stat-desc text-xs">
                                {{ ucfirst($jobListing->budget_type) }}</div>
                        </div>
                    </div>
                </div>

                {{-- Posted By (Client) --}}
                <a href="{{ route('client.profile', $jobListing->client) }}"
                    class="link link-hover">
                    <div class="flex items-center gap-3 py-4">
                        <div class="avatar avatar-placeholder">
                            <div
                                class="bg-primary text-neutral-content rounded-full w-10">
                                <span
                                    class="text-sm">{{ substr($jobListing->client->name, 0, 1) }}</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-base-content/60">Posted by
                            </p>
                            <p class="font-semibold">
                                {{ $jobListing->client->name }}</p>
                        </div>
                    </div>
                </a>

                {{-- Description --}}
                <div class="py-4">
                    <h2 class="text-xl font-bold mb-3 flex items-center gap-2">
                        <span class="text-2xl">💬</span>
                        Description
                    </h2>
                    <p
                        class="text-base-content/80 leading-relaxed whitespace-pre-line">
                        {{ $jobListing->description }}</p>
                </div>

                {{-- Skills Required --}}
                @if (!empty($jobListing->skills_required))
                    <div class="py-4">
                        <h2
                            class="text-xl font-bold mb-3 flex items-center gap-2">
                            <span class="text-2xl">💡</span>
                            Skills Required
                        </h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($jobListing->skills_required as $skill)
                                <span
                                    class="badge badge-lg badge-outline badge-primary">{{ $skill }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Job Details Grid --}}
                <div class="py-4">
                    <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                        <span class="text-2xl">📌</span>
                        Job Details
                    </h2>
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
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
                </div>

                {{-- Action Buttons for Client --}}
                @if (Auth::user()->role === 'client')
                    <div class="divider"></div>
                    <div class="pt-2">
                        <a href="{{ route('client.jobs.edit', $jobListing) }}"
                            class="btn btn-primary btn-lg gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Job Listing
                        </a>
                    </div>
                @endif

            </div>
        </div>

        {{-- PENDING APPLICANTS SECTION (Only for Open Jobs) --}}
        @if ($jobListing->status === 'open')
            <div class="card bg-base-100 shadow-xl border border-base-300">
                <div class="card-body">
                    <h2
                        class="card-title text-2xl mb-4 flex items-center gap-2">
                        <span class="text-2xl">🧑‍💻</span>
                        Pending Applicants
                        <div class="badge badge-lg badge-primary">
                            {{ $applicants->count() }}</div>
                    </h2>

                    @if ($applicants->isEmpty())
                        <div class="alert">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                class="stroke-info shrink-0 w-6 h-6">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <span>No pending applicants yet. Share your job
                                listing to attract more freelancers!</span>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach ($applicants as $application)
                                <div
                                    class="card bg-base-200 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="card-body p-4">
                                        <div
                                            class="flex flex-col md:flex-row items-center gap-4">

                                            {{-- Avatar --}}
                                            <div class="avatar">
                                                <div
                                                    class="w-16 h-16 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                                    <div
                                                        class="flex items-center justify-center w-full h-full bg-primary text-primary-content text-2xl font-bold">
                                                        {{ strtoupper(substr($application->freelancer->name, 0, 1)) }}
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Name & Applied Date --}}
                                            <div
                                                class="flex-1 text-center md:text-left">
                                                <p class="font-bold text-lg">
                                                    {{ $application->freelancer->name }}
                                                </p>
                                                <p
                                                    class="text-sm opacity-70 flex items-center justify-center md:justify-start gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    Applied on
                                                    {{ $application->created_at->format('M d, Y') }}
                                                </p>
                                            </div>

                                            {{-- Actions --}}
                                            <div
                                                class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
                                                <button
                                                    class="btn btn-success btn-sm gap-2"
                                                    onclick="openAcceptModal({{ $application->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Accept
                                                </button>
                                                <button
                                                    class="btn btn-error btn-sm gap-2"
                                                    onclick="openRejectModal({{ $application->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    Reject
                                                </button>
                                                {{-- <a href="{{ route('client.jobs.applicant', [$jobListing, $application->freelancer_id]) }}"
                                                    class="btn btn-secondary btn-sm gap-2"> --}}
                                                <a href="{{ route('freelancer.profile', $application->freelancer_id) }}"
                                                    class="btn btn-secondary btn-sm gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                    View Profile
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="divider"></div>
                        <a href="{{ route('client.jobs.applicants', $jobListing) }}"
                            class="btn btn-outline btn-secondary btn-block gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            View All Applicants
                        </a>
                    @endif
                </div>
            </div>
        @endif

        {{-- IN PROGRESS STATUS --}}
        @if ($jobListing->status === 'in_progress')
            <div class="card bg-base-100 shadow-xl border border-warning">
                <div class="card-body">
                    <h2
                        class="card-title text-2xl mb-4 flex items-center gap-2">
                        <span class="text-2xl">⏳</span>
                        Job In Progress
                    </h2>

                    <div class="flex flex-col md:flex-row items-start gap-6">
                        {{-- Avatar --}}
                        <div class="avatar self-center md:self-start">
                            <div
                                class="w-20 h-20 rounded-full ring ring-warning ring-offset-base-100 ring-offset-2">
                                <div
                                    class="flex items-center justify-center w-full h-full bg-warning text-warning-content text-3xl font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 w-full">
                            <div
                                class="flex flex-col sm:flex-row sm:items-center gap-2 mb-2">
                                <h3 class="text-xl font-bold">Accepted
                                    Freelancer</h3>
                                <div
                                    class="badge badge-warning badge-lg gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    In Progress
                                </div>
                            </div>

                            <a href="{{ route('client.jobs.applicant', [$jobListing, $user]) }}"
                                class="link link-primary text-lg font-semibold mb-2 inline-block">
                                {{ $user->name }}
                            </a>

                            <div class="alert alert-info mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    class="stroke-current shrink-0 w-6 h-6">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                <span>This freelancer is currently working on
                                    your job.</span>
                            </div>

                            {{-- Mark Complete Section --}}
                            <div class="mt-4">
                                @include('client.jobs.partials.mark-complete-section')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- COMPLETED OR CANCELLED STATUS --}}
        @if ($jobListing->status === 'completed' || $jobListing->status === 'cancelled')
            <div
                class="card bg-base-100 shadow-xl border {{ $jobListing->status === 'completed' ? 'border-success' : 'border-error' }}">
                <div class="card-body">
                    <h2
                        class="card-title text-2xl mb-4 flex items-center gap-2">
                        <span
                            class="text-2xl">{{ $jobListing->status === 'completed' ? '🏆' : '❌' }}</span>
                        Job {{ ucfirst($jobListing->status) }}
                    </h2>

                    <div class="flex flex-col md:flex-row items-start gap-6">
                        {{-- Avatar --}}
                        <div class="avatar self-center md:self-start">
                            <div
                                class="w-20 h-20 rounded-full ring {{ $jobListing->status === 'completed' ? 'ring-success' : 'ring-error' }} ring-offset-base-100 ring-offset-2">
                                <div
                                    class="flex items-center justify-center w-full h-full {{ $jobListing->status === 'completed' ? 'bg-success text-success-content' : 'bg-error text-error-content' }} text-3xl font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 w-full">
                            <div
                                class="flex flex-col sm:flex-row sm:items-center gap-2 mb-2">
                                <h3 class="text-xl font-bold">
                                    {{ $jobListing->status === 'completed' ? 'Completed by' : 'Cancelled Freelancer' }}
                                </h3>
                                <div
                                    class="badge {{ $jobListing->status === 'completed' ? 'badge-success' : 'badge-error' }} badge-lg">
                                    {{ ucfirst($jobListing->status) }}
                                </div>
                            </div>

                            <a href="{{ route('client.jobs.applicant', [$jobListing, $user]) }}"
                                class="link {{ $jobListing->status === 'completed' ? 'link-primary' : 'link-error' }} text-lg font-semibold mb-2 inline-block">
                                {{ $user->name }}
                            </a>

                            <div
                                class="alert {{ $jobListing->status === 'completed' ? 'alert-success' : 'alert-error' }} mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    class="stroke-current shrink-0 w-6 h-6">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                <span>{{ $jobListing->status === 'completed' ? 'Congratulations! This freelancer has completed your job.' : 'This freelancer was removed from the job.' }}</span>
                            </div>

                            {{-- Review Section --}}
                            @if ($jobListing->review)
                                <div class="card bg-base-200 shadow-sm mt-4">
                                    <div class="card-body">
                                        <h3
                                            class="card-title text-lg flex items-center gap-2">
                                            <span>⭐</span>
                                            Your Review
                                        </h3>
                                        <div class="space-y-2">
                                            <div
                                                class="flex items-center gap-2">
                                                <span
                                                    class="font-semibold">Rating:</span>
                                                <div class="rating rating-sm">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <input type="radio"
                                                            class="mask mask-star-2 bg-yellow-400"
                                                            disabled
                                                            {{ $i <= $jobListing->review->rating ? 'checked' : '' }} />
                                                    @endfor
                                                </div>
                                                <span
                                                    class="text-sm font-bold">{{ $jobListing->review->rating }}
                                                    / 5</span>
                                            </div>
                                            @if ($jobListing->review->comments)
                                                <div>
                                                    <span
                                                        class="font-semibold">Comments:</span>
                                                    <p
                                                        class="text-sm mt-1 text-base-content/80">
                                                        {{ $jobListing->review->comments }}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Payment Record Section --}}
                            @if ($jobListing->paymentRecord)
                                <div class="card bg-base-200 shadow-sm mt-4">
                                    <div class="card-body">
                                        <h3
                                            class="card-title text-lg flex items-center gap-2">
                                            <span>💰</span>
                                            Payment Information
                                        </h3>
                                        <div class="space-y-3">
                                            <div
                                                class="stat bg-base-100 rounded-lg">
                                                <div
                                                    class="stat-title text-xs">
                                                    Amount Paid</div>
                                                <div
                                                    class="stat-value text-success text-2xl">
                                                    ₱{{ number_format($jobListing->paymentRecord->price, 2) }}
                                                </div>
                                            </div>
                                            <div>
                                                <p class="font-semibold mb-2">
                                                    Proof of Payment:</p>
                                                <a href="{{ Storage::url($jobListing->paymentRecord->proof_of_payment) }}"
                                                    target="_blank"
                                                    class="btn btn-secondary gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    View Proof of Payment
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

    {{-- Accept Confirmation Modal --}}
    <dialog id="accept_modal"
        class="modal modal-bottom sm:modal-middle">
        <form method="POST"
            id="acceptForm"
            class="modal-box">
            @csrf
            @method('PUT')
            <h3 class="font-bold text-2xl mb-4">Accept This Applicant?</h3>
            <div class="alert alert-success mb-4">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    class="stroke-current shrink-0 w-6 h-6">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
                <span>You are about to accept this applicant. They will be
                    notified and the job status will change to "In
                    Progress".</span>
            </div>
            <div class="modal-action">
                <button type="button"
                    class="btn btn-ghost"
                    onclick="closeAcceptModal()">Cancel</button>
                <button type="submit"
                    class="btn btn-success gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>
                    Yes, Accept
                </button>
            </div>
        </form>
        <form method="dialog"
            class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    {{-- Reject Confirmation Modal --}}
    <dialog id="reject_modal"
        class="modal modal-bottom sm:modal-middle">
        <form method="POST"
            id="rejectForm"
            class="modal-box">
            @csrf
            @method('PUT')
            <h3 class="font-bold text-2xl mb-4">Reject This Applicant?</h3>
            <div class="alert alert-warning mb-4">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="stroke-current shrink-0 h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>You are about to reject this applicant. This action cannot
                    be undone.</span>
            </div>
            <div class="modal-action">
                <button type="button"
                    class="btn btn-ghost"
                    onclick="closeRejectModal()">Cancel</button>
                <button type="submit"
                    class="btn btn-error gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Yes, Reject
                </button>
            </div>
        </form>
        <form method="dialog"
            class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <script>
        function openAcceptModal(applicationId) {
            const form = document.getElementById('acceptForm');
            form.action = `/client/jobs/${applicationId}/accept`;
            const modal = document.getElementById('accept_modal');
            modal.showModal();
        }

        function openRejectModal(applicationId) {
            const form = document.getElementById('rejectForm');
            form.action = `/client/jobs/${applicationId}/reject`;
            const modal = document.getElementById('reject_modal');
            modal.showModal();
        }

        function closeAcceptModal() {
            document.getElementById('accept_modal').close();
        }

        function closeRejectModal() {
            document.getElementById('reject_modal').close();
        }
    </script>

</x-layouts.app>
