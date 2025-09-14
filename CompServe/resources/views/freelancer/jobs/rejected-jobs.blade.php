<x-layouts.app>
    <div class="breadcrumbs text-sm">
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li>Rejected Jobs</li>
        </ul>
    </div>

    <div class="flex justify-between items-center mb-4">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                {{ __('Rejected Jobs') }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                {{ __('Rejected job applications.') }}
            </p>
        </div>
    </div>


    @if ($rejectedJobs->count())
        <div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($rejectedJobs as $application)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">

                        <div class="flex gap-2 justify-between items-center">
                            <h2
                                class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                                <a href="{{ route('client.jobs.show', $application->job->id) }}"
                                    class="hover:underline text-blue-600 dark:text-blue-400">
                                    {{ Str::limit($application->job->title, 30) }}
                                </a>
                            </h2>

                            {{-- Freelancer applying for a job --}}
                            @php
                                $rejected = \App\Models\JobApplication::where([
                                    ['job_id', '=', $application->job->id],
                                    ['freelancer_id', '=', Auth::user()->id],
                                ])->exists();
                            @endphp

                            @if ($rejected)
                                <div
                                    class="badge badge-error badge-outline p-3 text-sm">
                                    Rejected</div>
                            @endif
                        </div>

                        <p class="text-gray-600 dark:text-gray-400 mb-2">
                            {{ Str::limit($application->job->description, 100) }}
                        </p>

                        <p class="text-gray-700 dark:text-gray-300">
                            <span class="font-medium">{{ __('Budget:') }}</span>
                            ${{ number_format($application->job->budget, 2) }}
                        </p>

                        <p class="text-gray-700 dark:text-gray-300">
                            <span
                                class="font-medium">{{ __('Location:') }}</span>
                            {{ $application->job->location ?? 'Remote' }}
                        </p>

                        <p
                            class="text-gray-500 dark:text-gray-400 text-sm mt-2">
                            {{ __('Posted on') }}
                            {{ $application->job->created_at->format('M d, Y') }}
                        </p>

                        <div class="mt-4">
                            <a href="{{ route('freelancer.jobs.show', $application->job->id) }}"
                                class="btn btn-primary">
                                {{ __('View Details') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $rejectedJobs->links() }}
            </div>
        </div>
    @else
        <p class="text-gray-700 dark:text-gray-300">
            {{ __('No jobs posted from employers yet.') }}
        </p>
    @endif
</x-layouts.app>
