<x-layouts.app>
    <div class="breadcrumbs text-sm">
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li>Applied Jobs</li>
        </ul>
    </div>

    <x-freelancer.jobs-header title="Applied Jobs"
        subtitle="Jobs you have applied to." />

    <x-freelancer.job-search-form :route="route('freelancer.jobs.applied')" />

    @if ($appliedJobs->count())
        <div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($appliedJobs as $application)
                    <x-freelancer.application-job-card :application="$application" />
                @endforeach
            </div>

            <div class="mt-4">
                {{ $appliedJobs->withQueryString()->links() }}
            </div>
        </div>
    @else
        <p class="text-gray-700 dark:text-gray-300">
            {{ __('No jobs posted from employers yet.') }}
        </p>
    @endif
</x-layouts.app>
