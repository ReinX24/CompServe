<x-layouts.app>
    <div
        class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
        <div class="mb-4 md:mb-0">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                {{ __('All Jobs') }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                {{ __('All your open, in progress, and completed jobs.') }}
            </p>
        </div>

        <div class="mt-2 md:mt-0">
            <a href="{{ route('client.jobs.create') }}"
                class="btn btn-neutral">
                + {{ __('Add Job') }}
            </a>
        </div>
    </div>

    {{-- Section: Open Jobs --}}
    <div class="mb-10">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">
            {{ __('Open Jobs') }}
        </h2>

        @php $openJobs = $jobs->where('status', 'open')->take(3); @endphp

        @if ($openJobs->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($openJobs as $job)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                        <h3
                            class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                            <a href="{{ route('client.jobs.show', $job->id) }}"
                                class="hover:underline text-blue-600 dark:text-blue-400">
                                {{ $job->title }}
                            </a>
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-2">
                            {{ Str::limit($job->description, 120) }}</p>
                        <p class="text-gray-700 dark:text-gray-300"><span
                                class="font-medium">Budget:</span>
                            ${{ number_format($job->budget, 2) }}</p>
                        <p
                            class="text-gray-500 dark:text-gray-400 text-sm mt-2">
                            Posted on {{ $job->created_at->format('M d, Y') }}
                        </p>
                    </div>
                @endforeach
            </div>

            @if ($jobs->where('status', 'open')->count() > 3)
                <div class="mt-4">
                    <a href="{{ route('client.jobs.posts') }}"
                        class="text-indigo-600 dark:text-indigo-400 hover:underline">
                        {{ __('See more open jobs →') }}
                    </a>
                </div>
            @endif
        @else
            <p class="text-gray-500 dark:text-gray-400">
                {{ __('No open jobs found.') }}</p>
        @endif
    </div>

    {{-- Section: In Progress Jobs --}}
    <div class="mb-10">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">
            {{ __('In Progress Jobs') }}
        </h2>

        @php $inProgressJobs = $jobs->where('status', 'in_progress')->take(3); @endphp

        @if ($inProgressJobs->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($inProgressJobs as $job)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                        <h3
                            class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                            <a href="{{ route('client.jobs.show', $job->id) }}"
                                class="hover:underline text-blue-600 dark:text-blue-400">
                                {{ $job->title }}
                            </a>
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-2">
                            {{ Str::limit($job->description, 120) }}</p>
                        <p class="text-gray-700 dark:text-gray-300"><span
                                class="font-medium">Budget:</span>
                            ${{ number_format($job->budget, 2) }}</p>
                        <p
                            class="text-gray-500 dark:text-gray-400 text-sm mt-2">
                            Posted on {{ $job->created_at->format('M d, Y') }}
                        </p>
                    </div>
                @endforeach
            </div>

            @if ($jobs->where('status', 'in_progress')->count() > 3)
                <div class="mt-4">
                    <a href="{{ route('client.jobs.in_progress') }}"
                        class="text-indigo-600 dark:text-indigo-400 hover:underline">
                        {{ __('See more in progress jobs →') }}
                    </a>
                </div>
            @endif
        @else
            <p class="text-gray-500 dark:text-gray-400">
                {{ __('No in progress jobs found.') }}</p>
        @endif
    </div>

    {{-- Section: Completed Jobs --}}
    <div>
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">
            {{ __('Completed Jobs') }}
        </h2>

        @php $completedJobs = $jobs->where('status', 'completed')->take(3); @endphp

        @if ($completedJobs->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($completedJobs as $job)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                        <h3
                            class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                            <a href="{{ route('client.jobs.show', $job->id) }}"
                                class="hover:underline text-blue-600 dark:text-blue-400">
                                {{ $job->title }}
                            </a>
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-2">
                            {{ Str::limit($job->description, 120) }}</p>
                        <p class="text-gray-700 dark:text-gray-300"><span
                                class="font-medium">Budget:</span>
                            ${{ number_format($job->budget, 2) }}</p>
                        <p
                            class="text-gray-500 dark:text-gray-400 text-sm mt-2">
                            Posted on {{ $job->created_at->format('M d, Y') }}
                        </p>
                    </div>
                @endforeach
            </div>

            @if ($jobs->where('status', 'completed')->count() > 3)
                <div class="mt-4">
                    <a href="{{ route('client.jobs.completed') }}"
                        class="text-indigo-600 dark:text-indigo-400 hover:underline">
                        {{ __('See more completed jobs →') }}
                    </a>
                </div>
            @endif
        @else
            <p class="text-gray-500 dark:text-gray-400">
                {{ __('No completed jobs found.') }}</p>
        @endif
    </div>
</x-layouts.app>
