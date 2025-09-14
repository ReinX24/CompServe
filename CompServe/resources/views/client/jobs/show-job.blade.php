<x-layouts.app>
    <div
        class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <!-- Title & Basic Info -->
        <div class="mb-6 flex flex-col gap-3">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                {{ $jobListing->title }}
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Category: <span
                    class="font-medium">{{ $jobListing->category }}</span>
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Status:
                @php
                    $statusColors = [
                        'open' => 'badge badge-success',
                        'in_progress' => 'badge badge-warning',
                        'completed' => 'badge badge-accent',
                    ];
                @endphp

                <span
                    class="{{ $statusColors[$jobListing->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100' }}">
                    {{ ucfirst(str_replace('_', ' ', $jobListing->status)) }}
                </span>
            </p>

        </div>

        <!-- Description -->
        <div class="mb-6">
            <h2
                class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">
                Description</h2>
            <p class="text-gray-700 dark:text-gray-300">
                {{ $jobListing->description }}
            </p>
        </div>

        <!-- Skills Required -->
        @if (!empty($jobListing->skills_required))
            <div class="mb-6">
                <h2
                    class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">
                    Skills Required</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach ($jobListing->skills_required as $skill)
                        <span
                            class="px-3 py-1 bg-indigo-100 dark:bg-indigo-700 text-indigo-800 dark:text-indigo-100 rounded-full text-sm">
                            {{ $skill }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Budget -->
        <div class="mb-6">
            <h2
                class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">
                Budget</h2>
            <p class="text-gray-700 dark:text-gray-300">
                {{ ucfirst($jobListing->budget_type) }} -
                <span
                    class="font-bold">₱{{ number_format($jobListing->budget, 2) }}</span>
            </p>
        </div>

        <!-- Location & Deadline -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <h2
                    class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">
                    Location</h2>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ $jobListing->location ?? 'Remote' }}
                </p>
            </div>
            <div>
                <h2
                    class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">
                    Deadline</h2>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ $jobListing->deadline ? $jobListing->deadline->format('M d, Y') : 'No deadline specified' }}
                </p>
            </div>
        </div>

        <!-- Action buttons -->
        <div class="flex space-x-3">
            <a href="{{ url()->previous() }}"
                class="px-3 py-2 btn btn-secondary">
                Back to Listings
            </a>
            @if (Auth::user()->role === 'freelancer')

                {{-- Freelancer applying for a job --}}
                @php
                    $alreadyApplied = \App\Models\JobApplication::where(
                        'job_id',
                        $jobListing->id,
                    )
                        ->where('freelancer_id', Auth::id())
                        ->exists();
                @endphp

                @if ($alreadyApplied)
                    {{-- TODO: when the user clicks the applied, ask if they want to remove application --}}
                    <button class="btn btn-success"
                        disabled="disabled">Applied</button>
                @else
                    <form action="{{ route('freelancer.jobs.store') }}"
                        method="POST">
                        @csrf
                        <input type="hidden"
                            name="jobId"
                            value="{{ $jobListing->id }}">
                        <button type="submit"
                            class="px-3 py-2 btn btn-primary">
                            Apply
                        </button>
                    </form>
                @endif
            @endif

            @if (Auth::user()->role === 'client')
                <a href="{{ route('client.jobs.edit', $jobListing) }}"
                    class="px-3 py-2 btn btn-primary">
                    Edit Job
                </a>
            @endif

        </div>


        {{-- Section that shows preview of applicants --}}
        @if ($jobListing->status === 'open')
            <div class="mt-6">
                <h2 class="text-lg font-semibold mb-3">Applicants Preview</h2>

                @if ($applicants->isEmpty())
                    <p class="text-gray-500">No applicants yet.</p>
                @else
                    <ul class="space-y-3">
                        @foreach ($applicants as $applicant)
                            <li
                                class="p-3 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-between">
                                <div>
                                    <p
                                        class="font-medium text-gray-900 dark:text-gray-100">
                                        {{ $applicant->freelancer->name }}
                                    </p>
                                    <p
                                        class="text-sm text-gray-500 dark:text-gray-400">
                                        Applied on
                                        {{ $applicant->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                                <a href="{{ route('client.jobs.applicant', [$jobListing, $applicant->freelancer_id]) }}"
                                    class="btn btn-outline btn-info">
                                    View Profile
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif

                {{-- Link to see all applicants --}}
                <div class="mt-3">
                    <a href="{{ route('client.jobs.applicants', $jobListing) }}"
                        class="btn btn-neutral">
                        View All Applicants
                    </a>
                </div>
            </div>
        @elseif ($jobListing->status === 'in_progress')
            <div class="mt-6">
                <div class="mb-3">
                    Accepted Applicant:
                    <a href="{{ route('client.jobs.applicant', [$jobListing, $user]) }}"
                        class="link link-primary">
                        {{ $user->name }}
                    </a>
                </div>

                <div class="mb-3">
                    <div class="flex space-x-3">
                        <form
                            action="{{ route('client.jobs.complete', $jobListing) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <button type="submit"
                                class="btn btn-success">Mark as
                                Complete</button>
                        </form>

                        <form
                            action="{{ route('client.jobs.cancel', $jobListing) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <button type="submit"
                                class="btn btn-error">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
