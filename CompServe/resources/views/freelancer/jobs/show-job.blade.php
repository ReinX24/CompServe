<x-layouts.app>
    <!-- Breadcrumbs with enhanced styling -->
    <div class="breadcrumbs text-xs sm:text-sm mb-4 sm:mb-6 px-4 sm:px-0">
        <ul class="text-base-content/60">
            <li><a href="{{ route('dashboard') }}"
                    class="hover:text-primary transition-colors flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-3 w-3 sm:h-4 sm:w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="hidden sm:inline">Dashboard</span>
                </a></li>
            @if ($jobListing->duration_type === 'gig')
                <li><a href="{{ route('freelancer.gigs.index') }}"
                        class="hover:text-primary transition-colors truncate max-w-[100px] sm:max-w-none">
                        <span class="hidden sm:inline">All Gigs</span>
                        <span class="sm:hidden">Gigs</span>
                    </a></li>
            @elseif($jobListing->duration_type === 'contract')
                <li><a href="{{ route('freelancer.contracts.index') }}"
                        class="hover:text-primary transition-colors truncate max-w-[100px] sm:max-w-none">
                        <span class="hidden sm:inline">All Contracts</span>
                        <span class="sm:hidden">Contracts</span>
                    </a></li>
            @endif
            <li class="text-primary font-semibold truncate max-w-[120px] sm:max-w-none">{{ $jobListing->title }}</li>
        </ul>
    </div>

    {{-- Success Message --}}
    @session('success')
        <div class="mb-4 sm:mb-6 animate-fade-in px-4 sm:px-0">
            <div role="alert"
                class="alert alert-success shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 sm:h-6 sm:w-6 shrink-0"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium text-sm sm:text-base">{{ session('success') }}</span>
            </div>
        </div>
    @endsession

    <div class="max-w-5xl mx-auto space-y-4 sm:space-y-6 px-4 sm:px-0">

        {{-- AI Summary Section --}}
        @include('jobs.partials.ai-summary')

        {{-- Main Job Card --}}
        <div class="card bg-base-100 shadow-xl border border-base-300 overflow-hidden">
            <!-- Decorative gradient header -->
            <div class="h-2 bg-linear-to-r from-primary via-secondary to-accent"></div>

            <div class="card-body p-4 sm:p-6 lg:p-8">

                {{-- Header Section --}}
                @include('freelancer.jobs.partials.show-job-header')

                {{-- Posted By --}}
                <a href="{{ route('client.profile', $jobListing->client) }}"
                    class="link link-hover group">
                    <div class="flex items-center gap-3 py-3 sm:py-4 px-3 sm:px-4 bg-base-200/50 rounded-xl hover:bg-base-200 transition-all duration-200 border border-base-300/50">
                        <div class="avatar avatar-placeholder">
                            <div
                                class="bg-linear-to-br from-primary to-primary/60 text-neutral-content rounded-full w-10 sm:w-12 ring-2 ring-primary/20 group-hover:ring-primary/40 transition-all">
                                <span
                                    class="text-sm sm:text-base font-bold">{{ substr($jobListing->client->name, 0, 1) }}</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-base-content/60 mb-0.5">Posted by</p>
                            <p class="font-semibold text-sm sm:text-base truncate group-hover:text-primary transition-colors">
                                {{ $jobListing->client->name }}</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40 group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>

                {{-- Description --}}
                <div class="py-3 sm:py-4">
                    <h2 class="text-lg sm:text-xl font-bold mb-3 flex items-center gap-2 bg-linear-to-r from-primary/10 to-transparent px-3 py-2 rounded-lg border-l-4 border-primary">
                        <span class="text-xl sm:text-2xl">💬</span>
                        <span>Description</span>
                    </h2>
                    <div class="bg-base-200/30 rounded-xl p-3 sm:p-4 border border-base-300/50">
                        <p class="text-sm sm:text-base text-base-content/80 leading-relaxed whitespace-pre-line">
                            {{ $jobListing->description }}</p>
                    </div>
                </div>

                {{-- Skills Required --}}
                @if (!empty($jobListing->skills_required))
                    <div class="py-3 sm:py-4">
                        <h2 class="text-lg sm:text-xl font-bold mb-3 flex items-center gap-2 bg-linear-to-r from-secondary/10 to-transparent px-3 py-2 rounded-lg border-l-4 border-secondary">
                            <span class="text-xl sm:text-2xl">💡</span>
                            <span>Skills Required</span>
                        </h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($jobListing->skills_required as $skill)
                                <span class="badge badge-md sm:badge-lg badge-outline badge-primary hover:badge-primary hover:text-primary-content transition-all duration-200 cursor-default">
                                    {{ $skill }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Job Details Grid --}}
                <div class="py-3 sm:py-4">
                    @include('freelancer.jobs.partials.show-job-details')
                </div>

                {{-- Action Buttons for Freelancer --}}
                @if (Auth::user()->role === 'freelancer')
                    <div class="divider my-4 sm:my-6"></div>
                    @include('freelancer.jobs.partials.action-buttons')
                @endif

            </div>
        </div>

        {{-- Completion/Cancellation Card --}}
        @if ($jobListing->status === 'completed' || $jobListing->status === 'cancelled')
            <div class="card bg-base-100 shadow-xl border-2 {{ $application->status === 'completed' ? 'border-success' : 'border-error' }} overflow-hidden">
                <!-- Decorative status header -->
                <div class="h-2 bg-linear-to-r {{ $jobListing->status === 'completed' ? 'from-success/50 via-success to-success/50' : 'from-error/50 via-error to-error/50' }}"></div>

                <div class="card-body p-4 sm:p-6 lg:p-8">
                    <h2 class="card-title text-xl sm:text-2xl mb-4 flex flex-wrap items-center gap-2">
                        <span class="text-2xl sm:text-3xl">{{ $jobListing->status === 'completed' ? '🏆' : '❌' }}</span>
                        <span>Job {{ ucfirst($jobListing->status) }}</span>
                        <div class="badge {{ $jobListing->status === 'completed' ? 'badge-success' : 'badge-error' }} badge-lg ml-auto">
                            {{ ucfirst($jobListing->status) }}
                        </div>
                    </h2>

                    <div class="flex flex-col sm:flex-row items-start gap-4 sm:gap-6">
                        {{-- Avatar --}}
                        <div class="avatar self-center sm:self-start">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full ring-4 {{ $jobListing->status === 'completed' ? 'ring-success' : 'ring-error' }} ring-offset-base-100 ring-offset-2 shadow-lg">
                                <div class="flex items-center justify-center w-full h-full {{ $jobListing->status === 'completed' ? 'bg-success text-success-content' : 'bg-error text-error-content' }} text-2xl sm:text-3xl font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 w-full">
                            <h3 class="text-lg sm:text-xl font-bold mb-2">
                                {{ $jobListing->status === 'completed' ? 'Completed by' : 'Cancelled Freelancer' }}
                            </h3>

                            <p class="text-base sm:text-lg font-semibold mb-3 {{ $jobListing->status === 'completed' ? 'text-success' : 'text-error' }}">
                                {{ Auth::user()->name }}
                            </p>

                            <div class="alert {{ $jobListing->status === 'completed' ? 'alert-success' : 'alert-error' }} shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    class="stroke-current shrink-0 w-5 h-5 sm:w-6 sm:h-6">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                <span class="text-sm sm:text-base">{{ $jobListing->status === 'completed' ? 'Congratulations! This freelancer has completed your job.' : 'This freelancer was removed from the job.' }}</span>
                            </div>

                            {{-- Review Section --}}
                            @if ($jobListing->review)
                                <div class="card bg-linear-to-br from-base-200 to-base-300 shadow-md mt-4 border border-base-300">
                                    <div class="card-body p-4 sm:p-6">
                                        <h3 class="card-title text-base sm:text-lg flex items-center gap-2">
                                            <span class="text-xl sm:text-2xl">⭐</span>
                                            <span>Your Review</span>
                                        </h3>
                                        <div class="space-y-3">
                                            <div class="flex flex-wrap items-center gap-2">
                                                <span class="font-semibold text-sm sm:text-base">Rating:</span>
                                                <div class="rating rating-sm sm:rating-md">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <input type="radio"
                                                            class="mask mask-star-2 bg-yellow-400"
                                                            disabled
                                                            {{ $i <= $jobListing->review->rating ? 'checked' : '' }} />
                                                    @endfor
                                                </div>
                                                <span class="text-sm sm:text-base font-bold bg-yellow-400 text-yellow-900 px-2 py-1 rounded-lg">
                                                    {{ $jobListing->review->rating }} / 5
                                                </span>
                                            </div>
                                            @if ($jobListing->review->comments)
                                                <div class="bg-base-100 rounded-lg p-3 sm:p-4">
                                                    <span class="font-semibold text-sm sm:text-base">Comments:</span>
                                                    <p class="text-sm sm:text-base mt-2 text-base-content/80 leading-relaxed">
                                                        {{ $jobListing->review->comments }}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Payment Record Section --}}
                            @if ($jobListing->paymentRecord)
                                <div class="card bg-linear-to-br from-success/5 to-success/10 shadow-md mt-4 border border-success/30">
                                    <div class="card-body p-4 sm:p-6">
                                        <h3 class="card-title text-base sm:text-lg flex items-center gap-2">
                                            <span class="text-xl sm:text-2xl">💰</span>
                                            <span>Payment Information</span>
                                        </h3>
                                        <div class="space-y-3 sm:space-y-4">
                                            <div class="stat bg-base-100 rounded-xl shadow-sm p-4 sm:p-6">
                                                <div class="stat-title text-xs sm:text-sm">Amount Paid</div>
                                                <div class="stat-value text-success text-2xl sm:text-3xl">
                                                    ₱{{ number_format($jobListing->paymentRecord->price, 2) }}
                                                </div>
                                            </div>
                                            <div>
                                                <p class="font-semibold mb-2 text-sm sm:text-base">Proof of Payment:</p>
                                                <a href="{{ Storage::url($jobListing->paymentRecord->proof_of_payment) }}"
                                                    target="_blank"
                                                    class="btn btn-secondary w-full sm:w-auto gap-2 shadow-lg hover:shadow-xl transition-all">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    <span class="text-sm sm:text-base">View Proof of Payment</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @include('freelancer.jobs.partials.modals')

    <script>
        function openApplyModal(jobId) {
            const form = document.getElementById('applyForm');
            if (form) {
                form.action = `/freelancer/jobs/${jobId}/apply`;
                const modal = document.getElementById('apply_modal');
                if (modal) modal.showModal();
            }
        }

        function closeApplyModal() {
            const modal = document.getElementById('apply_modal');
            if (modal) modal.close();
        }

        function openRemoveModal(jobId) {
            const form = document.getElementById('removeForm');
            if (form) {
                form.action = `/freelancer/jobs/${jobId}/destroy`;
                const modal = document.getElementById('remove_modal');
                if (modal) modal.showModal();
            }
        }

        function closeRemoveModal() {
            const modal = document.getElementById('remove_modal');
            if (modal) modal.close();
        }
    </script>

    <style>
        /* Smooth animations */
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }

        /* Ensure touch targets are at least 44x44px on mobile */
        @media (max-width: 640px) {
            .btn {
                min-height: 44px;
            }

            .badge {
                min-height: 28px;
            }
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }
    </style>

</x-layouts.app>