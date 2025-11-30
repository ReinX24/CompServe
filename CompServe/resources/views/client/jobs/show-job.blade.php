<x-layouts.app>
    <div class="breadcrumbs text-sm mb-4">
        <ul class="text-base-content/70">
            <li><a href="{{ route('dashboard') }}"
                    class="hover:text-primary">Dashboard</a></li>
            @if ($jobListing->duration_type === 'gig')
                <li><a href="{{ route('client.gigs.index') }}"
                        class="hover:text-primary">All Gigs</a></li>
            @elseif($jobListing->duration_type === 'contract')
                <li><a href="{{ route('client.contracts.index') }}"
                        class="hover:text-primary">All Contracts</a></li>
            @endif
            <li class="text-primary font-semibold">{{ $jobListing->title }}</li>
        </ul>
    </div>

    <div class="max-w-4xl mx-auto bg-base-200 text-base shadow rounded-lg p-6">

        {{-- Success Message --}}
        @session('success')
            <div class="mb-4">
                <div class="alert alert-success alert-soft text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 shrink-0 stroke-current"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endsession

        {{-- HEADER --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold my-2">📝 {{ $jobListing->title }}</h1>

            <p class="my-2 text-sm">
                <span class="font-medium">📂 Category:</span>
                {{ Str::headline($jobListing->category) }}
            </p>

            <p class="text-sm my-2">
                <span class="font-medium">👤 Posted by:</span>
                {{ $jobListing->client->name }}
            </p>

            @php
                $statusColors = [
                    'open' => 'badge badge-success badge-outline',
                    'in_progress' => 'badge badge-warning badge-outline',
                    'completed' => 'badge badge-accent badge-outline',
                    'cancelled' => 'badge badge-error badge-outline',
                ];
            @endphp

            @php
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

            <p class="mt-1 text-sm font-medium">
                Status:
                <span
                    class="{{ $statusColors[$jobListing->status] ?? 'badge' }}">
                    {{ $statusEmoji[$jobListing->status] ?? '📌' }}
                    {{ ucfirst(str_replace('_', ' ', $jobListing->status)) }}
                </span>
            </p>
        </div>

        {{-- DESCRIPTION --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">💬 Description</h2>
            <p class="leading-relaxed">{{ $jobListing->description }}</p>
        </div>

        {{-- SKILLS --}}
        @if (!empty($jobListing->skills_required))
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">💡 Skills Required</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach ($jobListing->skills_required as $skill)
                        <span
                            class="badge badge-outline border-primary text-primary">{{ $skill }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- JOB DETAILS SECTION --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">📌 Job Details</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <p class="text-sm font-semibold">🕒 Type</p>
                    <p>{{ $jobListing->duration_type === 'gig' ? 'Gig (Short-term)' : 'Contract (Long-term)' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm font-semibold">⏳ Duration</p>
                    <p>{{ $jobListing->duration ?? 'Not specified' }}</p>
                </div>

                <div>
                    <p class="text-sm font-semibold">💰 Budget Type</p>
                    <p>{{ ucfirst($jobListing->budget_type) }}</p>
                </div>

                <div>
                    <p class="text-sm font-semibold">💵 Budget</p>
                    <p class="font-bold">
                        ₱{{ number_format($jobListing->budget, 2) }}</p>
                </div>

                <div>
                    <p class="text-sm font-semibold">📍 Location</p>
                    <p>{{ $jobListing->location ?? 'Remote' }}</p>
                </div>

                <div>
                    <p class="text-sm font-semibold">📅 Deadline</p>
                    <p>{{ $jobListing->deadline ? $jobListing->deadline->format('M d, Y') : 'No deadline' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm font-semibold">📤 Posted On</p>
                    <p>{{ $jobListing->created_at->format('M d, Y') }}</p>
                </div>

                <div>
                    <p class="text-sm font-semibold">🔄 Last Updated</p>
                    <p>{{ $jobListing->updated_at->format('M d, Y') }}</p>
                </div>

            </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="flex space-x-3 mb-6">
            @if (Auth::user()->role === 'freelancer')
                @php
                    $alreadyApplied = \App\Models\JobApplication::where(
                        'job_id',
                        $jobListing->id,
                    )
                        ->where('freelancer_id', Auth::id())
                        ->exists();
                @endphp

                @if ($alreadyApplied)
                    <button class="btn btn-success"
                        disabled>Applied</button>
                @else
                    <form action="{{ route('freelancer.jobs.store') }}"
                        method="POST">
                        @csrf
                        <input type="hidden"
                            name="jobId"
                            value="{{ $jobListing->id }}">
                        <button class="btn btn-primary">Apply</button>
                    </form>
                @endif
            @endif

            @if (Auth::user()->role === 'client')
                <a href="{{ route('client.jobs.edit', $jobListing) }}"
                    class="btn btn-primary">Edit Job</a>
            @endif
        </div>

        {{-- APPLICANTS SECTION --}}
        @if ($jobListing->status === 'open')
            <div>
                <h2 class="text-xl font-semibold mb-3">🧑‍💻 Pending Applicants
                </h2>

                @if ($applicants->isEmpty())
                    <p>No pending applicants.</p>
                @else
                    <ul class="list bg-base-100 rounded-box shadow-md">
                        @foreach ($applicants as $application)
                            <li
                                class="list-row p-4 flex flex-col md:flex-row items-start md:items-center md:gap-4 gap-3">

                                {{-- Avatar --}}
                                <div class="avatar self-center md:self-start">
                                    <div
                                        class="w-16 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                        <div
                                            class="flex items-center justify-center w-full h-full bg-neutral text-neutral-content text-3xl font-bold">
                                            {{ strtoupper(substr($application->freelancer->name, 0, 1)) }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Name + Applied Date --}}
                                <div class="flex-1 text-center md:text-left">
                                    <p class="font-semibold text-lg">
                                        {{ $application->freelancer->name }}
                                    </p>
                                    <p class="text-xs opacity-70">Applied on
                                        {{ $application->created_at->format('M d, Y') }}
                                    </p>
                                </div>

                                {{-- Actions --}}
                                <div
                                    class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                                    <button
                                        class="btn btn-success btn-sm md:btn-md w-full md:w-auto"
                                        onclick="openAcceptModal({{ $application->id }})">Accept</button>
                                    <button
                                        class="btn btn-error btn-sm md:btn-md w-full md:w-auto"
                                        onclick="openRejectModal({{ $application->id }})">Reject</button>
                                    @include('client.jobs.partials.application-confirm-modals')
                                    <a href="{{ route('client.jobs.applicant', [$jobListing, $application->freelancer_id]) }}"
                                        class="btn btn-secondary btn-sm md:btn-md w-full md:w-auto">View
                                        Profile</a>
                                </div>

                            </li>
                        @endforeach
                    </ul>
                @endif

                <div class="mt-3">
                    <a href="{{ route('client.jobs.applicants', $jobListing) }}"
                        class="btn btn-secondary">View All Applicants</a>
                </div>
            </div>
        @endif

        {{-- IN PROGRESS / COMPLETED / CANCELLED --}}
        @if ($jobListing->status === 'in_progress')
            <div
                class="mt-6 card bg-base-100 shadow-md p-4 flex flex-col md:flex-row items-start gap-4">

                {{-- Avatar --}}
                <div class="avatar">
                    <div
                        class="w-16 h-16 rounded-full ring ring-warning ring-offset-base-100 ring-offset-2">
                        <div
                            class="flex items-center justify-center w-full h-full bg-warning text-warning-content text-2xl font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>
                </div>

                {{-- Name & Status --}}
                <div class="flex-1 w-full">
                    <div class="flex items-center gap-2 mb-1">
                        <p class="text-lg font-semibold">✅ Accepted
                            Applicant
                        </p>

                        {{-- Badge --}}
                        <div class="hidden md:flex">
                            <span class="badge badge-warning badge-outline">In
                                Progress</span>
                        </div>
                    </div>

                    <a href="{{ route('client.jobs.applicant', [$jobListing, $user]) }}"
                        class="link link-primary text-sm md:text-base">{{ $user->name }}</a>

                    <p class="text-xs text-gray-500 mt-1">
                        {{ $jobListing->status === 'completed' ? 'Congratulations! This applicant has now finished this job.' : 'This applicant was removed from the job.' }}
                    </p>

                    <div class="mt-3 w-full">
                        @include('client.jobs.partials.mark-complete-section')
                    </div>
                </div>
            </div>
        @endif

        {{-- @if ($jobListing->status === 'completed')
            <div
                class="mt-6 card bg-base-100 shadow-md p-4 flex flex-col md:flex-row items-center gap-4">
                <div class="avatar">
                    <div
                        class="w-16 h-16 rounded-full ring ring-success ring-offset-base-100 ring-offset-2">
                        <div
                            class="flex items-center justify-center w-full h-full bg-success text-success-content text-2xl font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-lg font-semibold">🏆 Completed Applicant</p>
                    <a href="{{ route('client.jobs.applicant', [$jobListing, $user]) }}"
                        class="link link-primary text-sm md:text-base">{{ $user->name }}</a>
                    <p class="text-xs text-gray-500 mt-1">Congratulations! This
                        applicant has now finished this job.</p>
                </div>
                <div class="hidden md:flex">
                    <span
                        class="badge badge-success badge-outline">Completed</span>
                </div>
            </div>
        @endif --}}

        {{-- @if ($jobListing->status === 'cancelled')
            <div
                class="mt-6 card bg-base-100 shadow-md p-4 flex flex-col md:flex-row items-center gap-4">
                <div class="avatar">
                    <div
                        class="w-16 h-16 rounded-full ring ring-error ring-offset-base-100 ring-offset-2">
                        <div
                            class="flex items-center justify-center w-full h-full bg-error text-error-content text-2xl font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-lg font-semibold">❌ Cancelled Applicant</p>
                    <a href="{{ route('client.jobs.applicant', [$jobListing, $user]) }}"
                        class="link link-error text-sm md:text-base">{{ $user->name }}</a>
                    <p class="text-xs text-gray-500 mt-1">This applicant was
                        removed from the job.</p>
                </div>
                <div class="hidden md:flex">
                    <span
                        class="badge badge-error badge-outline">Cancelled</span>
                </div>
            </div>
        @endif --}}

        @if ($jobListing->status === 'completed' || $jobListing->status === 'cancelled')
            <div
                class="mt-6 card bg-base-100 shadow-md p-4 flex flex-col md:flex-row items-start gap-4">

                {{-- Avatar --}}
                <div class="avatar">
                    <div
                        class="w-16 h-16 rounded-full {{ $jobListing->status === 'completed' ? 'ring ring-success' : 'ring ring-error' }} ring-offset-base-100 ring-offset-2">
                        <div
                            class="flex items-center justify-center w-full h-full {{ $jobListing->status === 'completed' ? 'bg-success text-success-content' : 'bg-error text-error-content' }} text-2xl font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>
                </div>

                {{-- Name & Status --}}
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <p class="text-lg font-semibold">
                            {{ $jobListing->status === 'completed' ? '🏆 Completed Applicant' : '❌ Cancelled Applicant' }}
                        </p>
                        <span
                            class="badge {{ $jobListing->status === 'completed' ? 'badge-success badge-outline' : 'badge-error badge-outline' }}">
                            {{ ucfirst($jobListing->status) }}
                        </span>
                    </div>

                    <a href="{{ route('client.jobs.applicant', [$jobListing, $user]) }}"
                        class="link {{ $jobListing->status === 'completed' ? 'link-primary' : 'link-error' }} text-sm md:text-base">
                        {{ $user->name }}
                    </a>

                    <p class="text-xs text-gray-500 mt-1">
                        {{ $jobListing->status === 'completed' ? 'Congratulations! This applicant has now finished this job.' : 'This applicant was removed from the job.' }}
                    </p>

                    {{-- REVIEW PANEL --}}
                    @if ($jobListing->review)
                        <div class="mt-3">
                            <h3 class="text-sm font-semibold mb-1">⭐ Client
                                Review</h3>
                            <div
                                class="bg-base-200 p-3 rounded-lg border border-base-300">
                                <p><strong>Rating:</strong>
                                    {{ $jobListing->review->rating }} / 5</p>
                                <p><strong>Comments:</strong>
                                    {{ $jobListing->review->comments ?? 'No comments provided.' }}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
