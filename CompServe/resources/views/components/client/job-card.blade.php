@props(['job'])

<div
    class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">

    <div class="flex gap-2 justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">
            <a href="{{ route('client.jobs.show', $job->id) }}"
                class="hover:underline text-blue-600 dark:text-blue-400">
                {{ Str::limit($job->title, 40) }}
            </a>
        </h2>

        <div class="badge badge-primary badge-outline p-3 text-sm">
            Open</div>
    </div>

    <p class="text-gray-600 dark:text-gray-400 mb-2">
        {{ Str::limit($job->description, 100) }}
    </p>

    <p class="text-gray-700 dark:text-gray-300">
        <span class="font-medium">{{ __('Budget:') }}</span>
        ${{ number_format($job->budget, 2) }}
    </p>

    <p class="text-gray-700 dark:text-gray-300">
        <span class="font-medium">{{ __('Location:') }}</span>
        {{ $job->location ?? 'Remote' }}
    </p>

    <p class="text-gray-700 dark:text-gray-300">
        <span class="font-medium">{{ __('Category:') }}</span>
        {{ $job->category }}
    </p>

    <p class="text-gray-700 dark:text-gray-300">
        <span class="font-medium">{{ __('Client:') }}</span>
        {{ $job->client->name }}
    </p>

    <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">
        {{ __('Posted on') }}
        {{ $job->created_at->format('M d, Y') }}
    </p>

    <div class="mt-4">
        <a href="{{ route('client.jobs.show', $job->id) }}"
            class="px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
            {{ __('View Details') }}
        </a>
    </div>
</div>
