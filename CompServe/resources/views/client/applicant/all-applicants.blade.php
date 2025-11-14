<x-layouts.app>
    <div class="breadcrumbs text-sm">
        <ul>
            <li><a href="{{ route('dashboard') }}"
                    class="btn btn-link">Dashboard</a></li>
            <li><a href="{{ route('client.jobs.show', $jobListing) }}"
                    class="btn btn-link">{{ Str::limit($jobListing->title, 10) }}</a>
            </li>
            <li>Applicants</li>
        </ul>
    </div>

    <div class="flex justify-between items-center mb-4">
        <div class="mb-6">
            <h1 class="text-2xl font-bold">
                {{ __('Applicants') }}
            </h1>
            <p class="mt-1">
                {{ __("Applicants for $jobListing->title") }}
            </p>
        </div>
    </div>

    @if ($applications->count())
        <div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($applications as $application)
                    <div
                        class="p-6 bg-base-200 shadow rounded-lg">

                        <h2 class="text-xl font-semibold mb-2">
                            <a href="{{ route('client.jobs.applicant', [$jobListing, $application->freelancer_id]) }}"
                                class="text-neutral">
                                {{ Str::limit($application->freelancer->name, 40) }}
                            </a>
                        </h2>
                    </div>
                @endforeach

            </div>
        </div>
    @endif
</x-layouts.app>
