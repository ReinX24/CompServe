<x-layouts.app>
    <div class="breadcrumbs text-sm">
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li>Available Jobs</li>
        </ul>
    </div>

    <x-freelancer.jobs-header title="Available Jobs"
        subtitle="Jobs you can apply to." />

    <x-freelancer.job-search-form />

    @if ($jobs->count())
        <div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($jobs as $job)
                    <x-freelancer.job-card :job="$job" />
                @endforeach
            </div>

            <div class="mt-4">
                {{ $jobs->withQueryString()->links() }}
            </div>
        </div>
    @else
        <p class="text-gray-700 dark:text-gray-300">
            {{ __('No jobs posted from employers yet.') }}
        </p>
    @endif
</x-layouts.app>
