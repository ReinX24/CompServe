<x-layouts.app>
    <div class="flex justify-between items-center mb-4">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                {{ __('Pending Jobs') }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                {{ __('Jobs currently in progress by freelancers.') }}
            </p>
        </div>

        <div class="mt-2 md:mt-0">
            <a href="{{ route('client.jobs.create') }}"
                class="btn btn-primary">
                + {{ __('Add Job') }}
            </a>
        </div>
    </div>

    @if ($jobs->count())
        <div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($jobs as $job)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">

                        <h2
                            class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">
                            <a href="{{ route('client.jobs.show', $job->id) }}"
                                class="hover:underline text-blue-600 dark:text-blue-400">
                                {{ $job->title }}
                            </a>
                        </h2>

                        <p class="text-gray-600 dark:text-gray-400 mb-2">
                            {{ Str::limit($job->description, 100) }}
                        </p>

                        <p class="text-gray-700 dark:text-gray-300">
                            <span class="font-medium">{{ __('Budget:') }}</span>
                            ${{ number_format($job->budget, 2) }}
                        </p>

                        <p class="text-gray-700 dark:text-gray-300">
                            <span
                                class="font-medium">{{ __('Location:') }}</span>
                            {{ $job->location ?? 'Remote' }}
                        </p>

                        <p
                            class="text-gray-500 dark:text-gray-400 text-sm mt-2">
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
                @endforeach
            </div>

            <div class="mt-4">
                {{ $jobs->links() }}
            </div>

        </div>
    @else
        <p class="text-gray-700 dark:text-gray-300">
            {{ __('You have not posted any jobs yet.') }}
        </p>
    @endif
</x-layouts.app>
