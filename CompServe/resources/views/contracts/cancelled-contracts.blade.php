<x-layouts.app>
    <div class="breadcrumbs text-sm mb-4">
        <ul class="text-base-content/70">
            <li><a href="{{ route('dashboard') }}"
                    class="hover:text-primary">Dashboard</a></li>
            <li class="text-primary font-semibold">Cancelled Contracts</li>
        </ul>
    </div>

    <div
        class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 bg-base-200 dark:bg-base-300 p-5 rounded-xl shadow-sm">
        <div>
            <h1 class="text-2xl font-bold text-primary">
                {{ __('Cancelled Contracts') }}
            </h1>
            <p class="mt-1 text-base-content/70">
                {{ __('All your cancelled contracts.') }}
            </p>
        </div>

        <div class="mt-3 md:mt-0">
            <a href="{{ route('client.jobs.create') }}"
                class="btn btn-primary shadow-md">
                + {{ __('Add Contract') }}
            </a>
        </div>
    </div>

    <x-client.job-search-form :route="route('client.jobs.posts')" />

    @if ($jobs->count())
        <div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($jobs as $job)
                    <x-client.job-card :job="$job" />
                @endforeach
            </div>

            <div class="mt-4">
                {{ $jobs->withQueryString()->links() }}
            </div>
        </div>
    @else
        <p class="text-gray-700 dark:text-gray-300">
            {{ __('You have not posted any jobs yet.') }}
        </p>
    @endif
</x-layouts.app>
