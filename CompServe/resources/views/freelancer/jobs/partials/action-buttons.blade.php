<div class="pt-3 sm:pt-4">
    @php
        $application = \App\Models\JobApplication::where('job_id', $jobListing->id)
            ->where('freelancer_id', Auth::id())
            ->first();
    @endphp

    @if ($application)
        @if ($application->status === 'pending')
            <!-- Pending State -->
            <div class="bg-linear-to-br from-warning/10 to-warning/5 rounded-2xl p-4 sm:p-6 border-2 border-warning/30 shadow-lg">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-warning/20 rounded-full flex items-center justify-center animate-pulse">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 sm:h-6 sm:w-6 text-warning"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-base sm:text-lg text-warning">Application Pending</h3>
                        <p class="text-xs sm:text-sm text-base-content/60">Waiting for client review</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                    <button class="btn btn-warning btn-lg flex-1 gap-2 shadow-md cursor-not-allowed opacity-75" disabled>
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
                        <span class="text-sm sm:text-base">Application Pending</span>
                    </button>
                    <button class="btn btn-outline btn-error btn-lg gap-2 hover:scale-105 transition-all shadow-md hover:shadow-lg"
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
                        <span class="text-sm sm:text-base">Withdraw</span>
                    </button>
                </div>
            </div>

        @elseif ($application->status === 'accepted')
            <!-- Accepted State -->
            <div class="bg-linear-to-br from-success/10 to-success/5 rounded-2xl p-4 sm:p-6 border-2 border-success/30 shadow-lg">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-success/20 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 sm:h-6 sm:w-6 text-success"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-base sm:text-lg text-success">Application Accepted! 🎉</h3>
                        <p class="text-xs sm:text-sm text-base-content/60">You can now start working on this job</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                    <button class="btn btn-success btn-lg flex-1 gap-2 shadow-md cursor-not-allowed opacity-75" disabled>
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
                        <span class="text-sm sm:text-base">Accepted</span>
                    </button>
                    <button class="btn btn-outline btn-error btn-lg gap-2 hover:scale-105 transition-all shadow-md hover:shadow-lg"
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
                        <span class="text-sm sm:text-base">Cancel Job</span>
                    </button>
                </div>
            </div>

        @elseif ($application->status === 'completed')
            <!-- Completed State -->
            <div class="bg-linear-to-br from-accent/10 to-accent/5 rounded-2xl p-4 sm:p-6 border-2 border-accent/30 shadow-lg">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-accent/20 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 sm:h-6 sm:w-6 text-accent"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-base sm:text-lg text-accent">Job Completed! 🏆</h3>
                        <p class="text-xs sm:text-sm text-base-content/60">Great work! This job has been finished</p>
                    </div>
                </div>

                <button class="btn btn-accent btn-lg w-full gap-2 shadow-md cursor-not-allowed opacity-75" disabled>
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
                    <span class="text-sm sm:text-base">Job Completed</span>
                </button>
            </div>

        @elseif ($application->status === 'rejected')
            <!-- Rejected State -->
            <div class="bg-linear-to-br from-error/10 to-error/5 rounded-2xl p-4 sm:p-6 border-2 border-error/30 shadow-lg">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-error/20 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 sm:h-6 sm:w-6 text-error"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-base sm:text-lg text-error">Application Rejected</h3>
                        <p class="text-xs sm:text-sm text-base-content/60">The client has declined your application</p>
                    </div>
                </div>

                <button class="btn btn-error btn-lg w-full gap-2 shadow-md cursor-not-allowed opacity-75" disabled>
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
                    <span class="text-sm sm:text-base">Application Rejected</span>
                </button>
            </div>

        @elseif ($application->status === 'cancelled')
            <!-- Cancelled State -->
            <div class="bg-linear-to-br from-error/10 to-error/5 rounded-2xl p-4 sm:p-6 border-2 border-error/30 shadow-lg">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-error/20 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 sm:h-6 sm:w-6 text-error"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-base sm:text-lg text-error">Job Cancelled</h3>
                        <p class="text-xs sm:text-sm text-base-content/60">This job has been cancelled</p>
                    </div>
                </div>

                <button class="btn btn-error btn-lg w-full gap-2 shadow-md cursor-not-allowed opacity-75" disabled>
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
                    <span class="text-sm sm:text-base">Job Cancelled</span>
                </button>
            </div>
        @endif

    @else
        <!-- No Application - Apply Button -->
        <div class="bg-linear-to-br from-primary/10 via-secondary/5 to-accent/10 rounded-2xl p-4 sm:p-6 border-2 border-primary/30 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-primary/20 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 sm:h-6 sm:w-6 text-primary"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-base sm:text-lg text-primary">Ready to Apply?</h3>
                    <p class="text-xs sm:text-sm text-base-content/60">Submit your application for this opportunity</p>
                </div>
            </div>

            <button class="btn btn-primary btn-lg w-full gap-2 shadow-lg hover:shadow-xl hover:scale-[1.02] transition-all duration-200 group"
                onclick="openApplyModal({{ $jobListing->id }})">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 sm:h-6 sm:w-6 group-hover:scale-110 transition-transform"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span class="text-sm sm:text-base font-semibold">Apply for this Job</span>
            </button>
        </div>
    @endif
</div>

<style>
    /* Ensure buttons are touch-friendly on mobile */
    @media (max-width: 640px) {
        .btn-lg {
            min-height: 48px;
            padding-left: 1.25rem;
            padding-right: 1.25rem;
        }
    }

    /* Add subtle animation for disabled buttons */
    .btn[disabled] {
        cursor: not-allowed;
    }

    /* Pulse animation for pending state */
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.7;
        }
    }
</style>