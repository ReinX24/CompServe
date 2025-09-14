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
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                {{ __('Applicants') }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                {{ __("Applicants for $jobListing->title") }}
            </p>
        </div>
    </div>

    @if ($applications->count())
        <div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($applications as $application)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">

                        <h2
                            class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">
                            <a href="{{ route('client.jobs.applicant', [$jobListing, $application->freelancer_id]) }}"
                                class="hover:underline text-blue-600 dark:text-blue-400">
                                {{ Str::limit($application->freelancer->name, 40) }}
                            </a>
                        </h2>
                    </div>
                @endforeach

            </div>
        </div>
    @endif
</x-layouts.app>
