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
                <li><a href="{{ route('freelancer.gigs.index') }}"
                        class="hover:text-primary transition-colors">All
                        Gigs</a></li>
            @elseif($jobListing->duration_type === 'contract')
                <li><a href="{{ route('freelancer.contracts.index') }}"
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

    <div class="max-w-5xl mx-auto space-y-6">

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

                {{-- Posted By --}}
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

                {{-- Action Buttons for Freelancer --}}
                @if (Auth::user()->role === 'freelancer')
                    <div class="divider"></div>
                    <div class="flex flex-col sm:flex-row gap-3 pt-2">
                        @php
                            $application = \App\Models\JobApplication::where(
                                'job_id',
                                $jobListing->id,
                            )
                                ->where('freelancer_id', Auth::id())
                                ->first();
                        @endphp

                        @if ($application)
                            @if ($application->status === 'pending')
                                <button class="btn btn-success btn-lg flex-1"
                                    disabled>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Application Pending
                                </button>
                                <button
                                    class="btn btn-outline btn-error btn-lg"
                                    onclick="openRemoveModal({{ $jobListing->id }})">
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
                                    Withdraw Application
                                </button>
                            @elseif ($application->status === 'accepted')
                                <button class="btn btn-success btn-lg flex-1"
                                    disabled>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Application Accepted
                                </button>
                                <button
                                    class="btn btn-outline btn-error btn-lg"
                                    onclick="openRemoveModal({{ $jobListing->id }})">
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
                                    Cancel Job
                                </button>
                            @elseif ($application->status === 'completed')
                                <button class="btn btn-success btn-lg flex-1"
                                    disabled>
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
                                    Job Completed
                                </button>
                            @elseif ($application->status === 'rejected')
                                <button class="btn btn-error btn-lg flex-1"
                                    disabled>
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
                                    Application Rejected
                                </button>
                            @elseif ($application->status === 'cancelled')
                                <button class="btn btn-error btn-lg flex-1"
                                    disabled>
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
                                    Job Cancelled
                                </button>
                            @endif
                        @else
                            <button class="btn btn-primary btn-lg flex-1 gap-2"
                                onclick="openApplyModal({{ $jobListing->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Apply for this Job
                            </button>
                        @endif
                    </div>
                @endif

            </div>
        </div>
        @if ($jobListing->status === 'completed' || $jobListing->status === 'cancelled')
            <div
                class="card bg-base-100 shadow-xl border {{ $application->status === 'completed' ? 'border-success' : 'border-error' }}">
                <div class="card-body">
                    <h2
                        class="card-title text-2xl mb-4 flex items-center gap-2">
                        <span
                            class="text-2xl">{{ $jobListing->status === 'completed' ? '🏆' : '❌' }}</span>
                        Job
                        {{ ucfirst($jobListing->status) }}
                    </h2>

                    <div class="flex flex-col md:flex-row items-start gap-6">
                        {{-- Avatar --}}
                        <div class="avatar self-center md:self-start">
                            <div
                                class="w-20 h-20 rounded-full ring {{ $jobListing->status === 'completed' ? 'ring-success' : 'ring-error' }} ring-offset-base-100 ring-offset-2">
                                <div
                                    class="flex items-center justify-center w-full h-full {{ $jobListing->status === 'completed' ? 'bg-success text-success-content' : 'bg-error text-error-content' }} text-3xl font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
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

                            <p
                                class="{{ $jobListing->status === 'completed' ? 'link-primary' : 'link-error' }} text-lg font-semibold mb-2 inline-block">
                                {{ Auth::user()->name }}
                            </p>

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
                                                    /
                                                    5</span>
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
                                            Payment
                                            Information
                                        </h3>
                                        <div class="space-y-3">
                                            <div
                                                class="stat bg-base-100 rounded-lg">
                                                <div
                                                    class="stat-title text-xs">
                                                    Amount
                                                    Paid
                                                </div>
                                                <div
                                                    class="stat-value text-success text-2xl">
                                                    ₱{{ number_format($jobListing->paymentRecord->price, 2) }}
                                                </div>
                                            </div>
                                            <div>
                                                <p class="font-semibold mb-2">
                                                    Proof of
                                                    Payment:
                                                </p>
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
                                                    View
                                                    Proof of
                                                    Payment
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

    {{-- Apply Confirmation Modal --}}
    <dialog id="apply_modal"
        class="modal modal-bottom sm:modal-middle">
        <form method="POST"
            id="applyForm"
            class="modal-box">
            @csrf
            <input type="hidden"
                name="jobId"
                id="applyJobId">
            <h3 class="font-bold text-2xl mb-4">Apply for this Job?</h3>
            <div class="alert alert-info mb-4">
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
                <span>You are about to submit your application for this job. The
                    client will review your profile and get back to you.</span>
            </div>
            <div class="modal-action">
                <button type="button"
                    class="btn btn-ghost"
                    onclick="closeApplyModal()">Cancel</button>
                <button type="submit"
                    class="btn btn-primary gap-2">
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
                    Confirm Application
                </button>
            </div>
        </form>
        <form method="dialog"
            class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    {{-- Remove / Cancel Confirmation Modal --}}
    <dialog id="remove_modal"
        class="modal modal-bottom sm:modal-middle">
        <form method="POST"
            id="removeForm"
            class="modal-box">
            @csrf
            @method('DELETE')
            <h3 class="font-bold text-2xl mb-4">Remove Application?</h3>
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
                <span>This action will remove/cancel your application. This
                    cannot be undone.</span>
            </div>
            <div class="modal-action">
                <button type="button"
                    class="btn btn-ghost"
                    onclick="closeRemoveModal()">Cancel</button>
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
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Yes, Remove
                </button>
            </div>
        </form>
        <form method="dialog"
            class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <script>
        function openApplyModal(jobId) {
            const form = document.getElementById('applyForm');
            form.action = `/freelancer/jobs/${jobId}/apply`;
            document.getElementById('apply_modal').showModal();
        }

        function closeApplyModal() {
            document.getElementById('apply_modal').close();
        }

        function openRemoveModal(jobId) {
            const form = document.getElementById('removeForm');
            form.action = `/freelancer/jobs/${jobId}/destroy`;
            document.getElementById('remove_modal').showModal();
        }

        function closeRemoveModal() {
            document.getElementById('remove_modal').close();
        }
    </script>

</x-layouts.app>
