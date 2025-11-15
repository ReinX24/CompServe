<x-layouts.app>
    {{-- Breadcrumbs --}}
    <div class="breadcrumbs text-sm mb-6">
        <ul class="text-base-content/70">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="hover:text-primary">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('client.jobs.show', $jobListing) }}"
                    class="hover:text-primary">
                    {{ Str::limit($jobListing->title, 20) }}
                </a>
            </li>
            <li class="text-primary font-semibold">Applicants</li>
        </ul>
    </div>

    {{-- Page Header --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-base-content">
                {{ __('Applicants') }}
            </h1>
            <p class="text-base-content/70 mt-1">
                {{ __("Freelancers who applied for: $jobListing->title") }}
            </p>
        </div>
    </div>

    {{-- Applicants List --}}
    @if ($applications->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($applications as $application)
                <div
                    class="card bg-base-100 shadow-md hover:shadow-xl transition-all duration-200 border border-base-300">
                    <div class="card-body">

                        {{-- Applicant --}}
                        <div class="flex items-center gap-4">
                            {{-- TODO: show avatar here --}}
                            {{-- <div class="avatar placeholder">
                                <div
                                    class="bg-neutral-focus text-neutral-content rounded-full w-12">
                                    <span class="text-xl">
                                        {{ strtoupper(substr($application->freelancer->name, 0, 1)) }}
                                    </span>
                                </div>
                            </div> --}}

                            <div>
                                <h2 class="text-lg font-semibold">
                                    <a href="{{ route('client.jobs.applicant', [$jobListing, $application->freelancer_id]) }}"
                                        class="hover:text-primary">
                                        {{ Str::limit($application->freelancer->name, 40) }}
                                    </a>
                                </h2>

                                {{-- Status Badge --}}
                                {{-- <span
                                    class="badge
                                    @if ($application->status == 'pending') badge-warning
                                    @elseif($application->status == 'accepted') badge-success
                                    @elseif($application->status == 'rejected') badge-error
                                    @else badge-ghost @endif">
                                    {{ ucfirst($application->status) }}
                                </span> --}}
                            </div>
                        </div>

                        {{-- View Button --}}
                        <div class="mt-4">
                            <a href="{{ route('client.jobs.applicant', [$jobListing, $application->freelancer_id]) }}"
                                class="btn btn-secondary w-full">
                                View Applicant
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    @else
        {{-- Empty State --}}
        <div
            class="mt-10 flex flex-col justify-center items-center text-center">
            <div class="text-6xl opacity-40">
                <i class="fa-solid fa-users-slash"></i>
            </div>
            <h3 class="text-xl font-semibold mt-4">
                No Applicants Found
            </h3>
            <p class="text-base-content/70 mt-1 max-w-md">
                No freelancers have applied to this job listing yet.
            </p>
        </div>
    @endif
</x-layouts.app>
