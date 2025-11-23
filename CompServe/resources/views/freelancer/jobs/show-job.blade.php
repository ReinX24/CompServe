<x-layouts.app>
    <div class="max-w-4xl mx-auto bg-base-200 text-base shadow rounded-lg p-6">

        @session('success')
            <div class="mb-4">
                {{-- Success message --}}
                <div role="alert"
                    class="alert alert-success alert-soft text-lg">
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

        <!-- Title & Basic Info -->
        <div class="mb-6 flex flex-col gap-3">
            <h1 class="text-3xl font-bold">
                {{ $jobListing->title }}
            </h1>

            <p class="text-sm">
                <span class="font-medium">Category:</span>
                {{ Str::headline($jobListing->category) }}
            </p>

            <p class="text-sm">
                Status:
                @php
                    $statusColors = [
                        'open' => 'badge badge-success badge-outline',
                        'in_progress' => 'badge badge-warning badge-outline',
                        'completed' => 'badge badge-accent badge-outline',
                        'cancelled' => 'badge badge-error badge-outline',
                    ];
                @endphp

                <span
                    class="{{ $statusColors[$jobListing->status] ?? 'badge badge-outline' }}">
                    {{ ucfirst(str_replace('_', ' ', $jobListing->status)) }}
                </span>
            </p>
        </div>

        <!-- Description -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Description</h2>
            <p>{{ $jobListing->description }}</p>
        </div>

        <!-- Skills Required -->
        @if (!empty($jobListing->skills_required))
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Skills Required</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach ($jobListing->skills_required as $skill)
                        <span
                            class="px-3 py-1 bg-indigo-100 dark:bg-indigo-700
                                     text-indigo-800 dark:text-indigo-100
                                     rounded-full text-sm">
                            {{ $skill }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Budget -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Budget</h2>
            <p>
                {{ ucfirst($jobListing->budget_type) }} –
                <span class="font-bold">
                    ₱{{ number_format($jobListing->budget, 2) }}
                </span>
            </p>
        </div>

        <!-- Location & Deadline -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <h2 class="text-xl font-semibold mb-2">Location</h2>
                <p>{{ $jobListing->location ?? 'Remote' }}</p>
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-2">Deadline</h2>
                <p>
                    {{ $jobListing->deadline ? $jobListing->deadline->format('M d, Y') : 'No deadline specified' }}
                </p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex space-x-3">

            @if (Auth::user()->role === 'freelancer')
                @php
                    $alreadyApplied = \App\Models\JobApplication::where(
                        'job_id',
                        $jobListing->id,
                    )
                        ->where('freelancer_id', Auth::id())
                        ->where('status', 'pending')
                        ->exists();

                    $alreadyAccepted = \App\Models\JobApplication::where(
                        'job_id',
                        $jobListing->id,
                    )
                        ->where('freelancer_id', Auth::id())
                        ->where('status', 'accepted')
                        ->exists();

                    $alreadyCompleted = \App\Models\JobApplication::where(
                        'job_id',
                        $jobListing->id,
                    )
                        ->where('freelancer_id', Auth::id())
                        ->where('status', 'completed')
                        ->exists();

                    $alreadyRejected = \App\Models\JobApplication::where(
                        'job_id',
                        $jobListing->id,
                    )
                        ->where('freelancer_id', Auth::id())
                        ->where('status', 'rejected')
                        ->exists();
                @endphp

                @if ($alreadyApplied)
                    <button class="btn btn-success"
                        disabled>Applied</button>

                    <form
                        action="{{ route('freelancer.jobs.removeApplication', $jobListing) }}"
                        method="POST"
                        onsubmit="return confirm('Remove your application?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-error">Remove</button>
                    </form>
                @elseif ($alreadyAccepted)
                    <button class="btn btn-success"
                        disabled>Accepted</button>

                    <form
                        action="{{ route('freelancer.jobs.removeApplication', $jobListing) }}"
                        method="POST"
                        onsubmit="return confirm('Cancel your accepted job application?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-error">Cancel</button>
                    </form>
                @elseif ($alreadyCompleted)
                    <button class="btn btn-success"
                        disabled>Completed</button>
                @elseif ($alreadyRejected)
                    <button class="btn btn-error"
                        disabled>Cancelled</button>
                @else
                    <form action="{{ route('freelancer.jobs.apply') }}"
                        method="POST">
                        @csrf
                        <input type="hidden"
                            name="jobId"
                            value="{{ $jobListing->id }}">
                        <button type="submit"
                            class="btn btn-primary">Apply</button>
                    </form>
                @endif
            @endif

            @if (Auth::user()->role === 'client')
                <a href="{{ route('client.jobs.edit', $jobListing) }}"
                    class="btn btn-primary">
                    Edit Job
                </a>
            @endif

        </div>
    </div>
</x-layouts.app>
