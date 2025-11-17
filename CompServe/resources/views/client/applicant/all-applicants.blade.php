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
                    class="card bg-base-200 shadow-sm hover:shadow-md transition-all duration-199 border border-base-300">
                    <div class="card-body">

                        {{-- Applicant --}}
                        <div class="flex items-center gap-4">
                            <div class="avatar">
                                <div
                                    class="w-16 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                    <div
                                        class="flex items-center justify-center w-full h-full bg-neutral text-neutral-content text-4xl font-bold">
                                        {{ strtoupper(substr($application->freelancer->name ?? Auth::user()->name, 0, 1)) }}
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h2 class="text-lg font-semibold">
                                    <a href="{{ route('client.jobs.applicant', [$jobListing, $application->freelancer_id]) }}"
                                        class="hover:text-primary">
                                        {{ Str::limit($application->freelancer->name, 40) }}
                                    </a>
                                </h2>

                                <p>{{ Str::ucfirst($application->status) }}</p>
                            </div>
                        </div>

                        {{-- Applicant Status Actions --}}
                        @if ($application->status === 'rejected')
                            <button class="btn btn-error w-full mt-4"
                                disabled>Rejected</button>
                        @elseif ($application->status === 'accepted')
                            <button class="btn btn-success w-full mt-4"
                                disabled>Accepted</button>
                        @else
                            {{-- Accept Applicant --}}
                            <div class="mt-4">
                                <form
                                    action="{{ route('client.jobs.applicant.accept', $application) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success w-full">
                                        Accept Applicant
                                    </button>
                                </form>
                            </div>

                            {{-- Reject Applicant --}}
                            <div class="mt-2">
                                <form
                                    action="{{ route('client.jobs.applicant.reject', $application) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-error w-full">
                                        Reject Applicant
                                    </button>
                                </form>
                            </div>
                        @endif

                        {{-- View Applicant --}}
                        <div class="mt-2">
                            <a href="{{ route('client.jobs.applicant', [$jobListing, $application->freelancer_id]) }}"
                                class="btn btn-outline btn-secondary w-full">
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
