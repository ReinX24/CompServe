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
                        'open' =>
                            'bg-green-100 text-green-800 dark:bg-green-500 dark:text-green-100',
                        'in_progress' =>
                            'bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-100',
                        'completed' =>
                            'bg-green-300 text-green-900 dark:bg-green-600 dark:text-green-100',
                    ];
                @endphp

                <span
                    class="px-2 py-1 rounded text-xs font-semibold {{ $statusColors[$jobListing->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100' }}">
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
            <a href="{{ route('client.jobs.posts') }}"
                class="px-3 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                Back to Listings
            </a>
            <a href="{{ route('client.jobs.edit', $jobListing) }}"
                class="px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Edit Job
            </a>
        </div>
    </div>
</x-layouts.app>
