<x-layouts.app>
    {{-- Breadcrumbs --}}
    <div class="breadcrumbs text-sm mb-6">
        <ul class="text-base-content/60">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="hover:text-primary transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('client.jobs.show', $jobListing) }}"
                    class="hover:text-primary transition-colors">
                    {{ Str::limit($jobListing->title, 20) }}
                </a>
            </li>
            <li class="text-primary font-semibold">Applicants</li>
        </ul>
    </div>

    {{-- Page Header --}}
    <div
        class="card bg-linear-to-r from-primary/10 to-secondary/10 shadow-lg mb-8 border border-base-300">
        <div class="card-body">
            <div
                class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="avatar avatar-placeholder">
                            <div
                                class="bg-primary text-primary-content rounded-lg w-12 h-12">
                                <span class="text-2xl">🧑‍💻</span>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-base-content">All
                                Applicants</h1>
                            <p class="text-base-content/70 mt-1">
                                Freelancers who applied for: <span
                                    class="font-semibold text-primary">{{ $jobListing->title }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="stats shadow bg-base-100">
                    <div class="stat place-items-center">
                        <div class="stat-title">Total Applicants</div>
                        <div class="stat-value text-primary">
                            {{ $applications->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Applicants List --}}
    @if ($applications->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($applications as $application)
                <div
                    class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 border border-base-300 hover:border-primary/50">
                    <div class="card-body">

                        {{-- Status Badge --}}
                        <div class="absolute top-4 right-4">
                            @php
                                $statusConfig = [
                                    'pending' => [
                                        'class' => 'badge-warning',
                                        'icon' => '🕒',
                                    ],
                                    'accepted' => [
                                        'class' => 'badge-success',
                                        'icon' => '✅',
                                    ],
                                    'rejected' => [
                                        'class' => 'badge-error',
                                        'icon' => '❌',
                                    ],
                                ];
                                $config = $statusConfig[
                                    $application->status
                                ] ?? ['class' => 'badge-ghost', 'icon' => '📌'];
                            @endphp
                            <div
                                class="badge {{ $config['class'] }} badge-lg gap-1">
                                {{ $config['icon'] }}
                                {{ Str::ucfirst($application->status) }}
                            </div>
                        </div>

                        {{-- Applicant Info --}}
                        <div
                            class="flex flex-col items-center text-center pt-6">
                            <div class="avatar mb-4">
                                <div
                                    class="w-20 rounded-full ring ring-primary ring-offset-base-100 ring-offset-4">
                                    <div
                                        class="flex items-center justify-center w-full h-full bg-linear-to-br from-primary to-secondary text-primary-content text-3xl font-bold">
                                        {{ strtoupper(substr($application->freelancer->name ?? Auth::user()->name, 0, 1)) }}
                                    </div>
                                </div>
                            </div>

                            <h2 class="card-title text-xl mb-1 justify-center">
                                <a href="{{ route('client.jobs.applicant', [$jobListing, $application->freelancer_id]) }}"
                                    class="hover:text-primary transition-colors">
                                    {{ $application->freelancer->name }}
                                </a>
                            </h2>

                            <p
                                class="text-sm text-base-content/60 flex items-center gap-1 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Applied
                                {{ $application->created_at->diffForHumans() }}
                            </p>

                            <div class="divider my-2"></div>

                            {{-- Action Buttons --}}
                            <div class="w-full space-y-2">
                                @if ($application->status === 'rejected')
                                    <button class="btn btn-error w-full gap-2"
                                        disabled>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Rejected
                                    </button>
                                @elseif ($application->status === 'accepted')
                                    <button class="btn btn-success w-full gap-2"
                                        disabled>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Accepted
                                    </button>
                                @else
                                    <button
                                        onclick="openAcceptModal({{ $application->id }})"
                                        class="btn btn-success w-full gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Accept
                                    </button>

                                    <button
                                        onclick="openRejectModal({{ $application->id }})"
                                        class="btn btn-error btn-outline w-full gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Reject
                                    </button>
                                @endif

                                <a href="{{ route('freelancer.profile', $application->freelancer_id) }}"
                                    class="btn btn-secondary btn-outline w-full gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    View Profile
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    @else
        {{-- Empty State --}}
        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body py-16">
                <div
                    class="flex flex-col justify-center items-center text-center">
                    <div class="mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-32 w-32 text-base-content/20"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">No Applicants Yet</h3>
                    <p class="text-base-content/70 max-w-md mb-6">
                        No freelancers have applied to this job listing yet.
                        Share your job to attract talented freelancers!
                    </p>
                    <div class="flex gap-2">
                        <a href="{{ route('client.jobs.show', $jobListing) }}"
                            class="btn btn-primary gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Job
                        </a>
                        <a href="{{ route('client.jobs.edit', $jobListing) }}"
                            class="btn btn-secondary btn-outline gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Job
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Accept Confirmation Modal --}}
    <dialog id="accept_modal"
        class="modal modal-bottom sm:modal-middle">
        <form method="POST"
            id="acceptForm"
            class="modal-box">
            @csrf
            @method('PUT')
            <h3 class="font-bold text-2xl mb-4">Accept This Applicant?</h3>
            <div class="alert alert-success mb-4">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    class="stroke-current shrink-0 w-6 h-6">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
                <span>You are about to accept this applicant. They will be
                    notified and the job status will change to "In
                    Progress".</span>
            </div>
            <div class="modal-action">
                <button type="button"
                    class="btn btn-ghost"
                    onclick="closeAcceptModal()">Cancel</button>
                <button type="submit"
                    class="btn btn-success gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>
                    Yes, Accept
                </button>
            </div>
        </form>
        <form method="dialog"
            class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    {{-- Reject Confirmation Modal --}}
    <dialog id="reject_modal"
        class="modal modal-bottom sm:modal-middle">
        <form method="POST"
            id="rejectForm"
            class="modal-box">
            @csrf
            @method('PUT')
            <h3 class="font-bold text-2xl mb-4">Reject This Applicant?</h3>
            <div class="alert alert-warning mb-4">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="stroke-current shrink-0 h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>You are about to reject this applicant. This action cannot
                    be undone.</span>
            </div>
            <div class="modal-action">
                <button type="button"
                    class="btn btn-ghost"
                    onclick="closeRejectModal()">Cancel</button>
                <button type="submit"
                    class="btn btn-error gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Yes, Reject
                </button>
            </div>
        </form>
        <form method="dialog"
            class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <script>
        function openAcceptModal(applicationId) {
            const form = document.getElementById('acceptForm');
            form.action = `/client/jobs/${applicationId}/accept`;
            const modal = document.getElementById('accept_modal');
            modal.showModal();
        }

        function openRejectModal(applicationId) {
            const form = document.getElementById('rejectForm');
            form.action = `/client/jobs/${applicationId}/reject`;
            const modal = document.getElementById('reject_modal');
            modal.showModal();
        }

        function closeAcceptModal() {
            document.getElementById('accept_modal').close();
        }

        function closeRejectModal() {
            document.getElementById('reject_modal').close();
        }
    </script>

</x-layouts.app>
