<div class="flex flex-col sm:flex-row gap-3 pt-2">
    @php
        $application = \App\Models\JobApplication::where(
            'job_id',
            $jobListing->id,
        )
            ->where('freelancer_id', Auth::id())
            ->first();
    @endphp

    @if ($application)
        @if ($application->status === 'pending')
            <button class="btn btn-success btn-lg flex-1"
                disabled>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Application Pending
            </button>
            <button class="btn btn-outline btn-error btn-lg"
                onclick="openRemoveModal({{ $jobListing->id }})">
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
                Withdraw Application
            </button>
        @elseif ($application->status === 'accepted')
            <button class="btn btn-success btn-lg flex-1"
                disabled>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Application Accepted
            </button>
            <button class="btn btn-outline btn-error btn-lg"
                onclick="openRemoveModal({{ $jobListing->id }})">
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
                Cancel Job
            </button>
        @elseif ($application->status === 'completed')
            <button class="btn btn-success btn-lg flex-1"
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
                Job Completed
            </button>
        @elseif ($application->status === 'rejected')
            <button class="btn btn-error btn-lg flex-1"
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
                Application Rejected
            </button>
        @elseif ($application->status === 'cancelled')
            <button class="btn btn-error btn-lg flex-1"
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
                Job Cancelled
            </button>
        @endif
    @else
        <button class="btn btn-primary btn-lg flex-1 gap-2"
            onclick="openApplyModal({{ $jobListing->id }})">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Apply for this Job
        </button>
    @endif
</div>
