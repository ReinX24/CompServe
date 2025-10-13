<x-layouts.app>
    <div class="breadcrumbs text-sm">
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li>In-progress Jobs</li>
        </ul>
    </div>

    <div class="flex justify-between items-center mb-4">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                {{ __('In-progress Jobs') }}
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

    <x-client.job-search-form :route="route('client.jobs.in_progress')" />

    @if ($jobs->count())
        <div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($jobs as $job)
                    <x-client.job-card :job="$job" />
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
