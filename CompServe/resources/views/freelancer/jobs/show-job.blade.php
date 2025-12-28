<x-layouts.app>
    <!-- Breadcrumbs with enhanced styling -->
    <div class="breadcrumbs text-sm mb-6">
        <ul class="text-base-content/60">
            <li><a href="{{ route('dashboard') }}"
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
                </a></li>
            @if ($jobListing->duration_type === 'gig')
                <li><a href="{{ route('freelancer.gigs.index') }}"
                        class="hover:text-primary transition-colors">All
                        Gigs</a></li>
            @elseif($jobListing->duration_type === 'contract')
                <li><a href="{{ route('freelancer.contracts.index') }}"
                        class="hover:text-primary transition-colors">All
                        Contracts</a></li>
            @endif
            <li class="text-primary font-semibold">{{ $jobListing->title }}</li>
        </ul>
    </div>

    {{-- Success Message --}}
    @session('success')
        <div class="mb-6 animate-fade-in">
            <div role="alert"
                class="alert alert-success shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 shrink-0"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endsession

    <div class="max-w-5xl mx-auto space-y-6">

        {{-- AI Summary Section --}}
        @include('jobs.partials.ai-summary')

        {{-- Main Job Card --}}
        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body">

                {{-- Header Section --}}
                @include('freelancer.jobs.partials.show-job-header')

                {{-- Posted By --}}
                <a href="{{ route('client.profile', $jobListing->client) }}"
                    class="link link-hover">
                    <div class="flex items-center gap-3 py-4">
                        <div class="avatar avatar-placeholder">
                            <div
                                class="bg-primary text-neutral-content rounded-full w-10">
                                <span
                                    class="text-sm">{{ substr($jobListing->client->name, 0, 1) }}</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-base-content/60">Posted by
                            </p>
                            <p class="font-semibold">
                                {{ $jobListing->client->name }}</p>
                        </div>
                    </div>
                </a>

                {{-- Description --}}
                <div class="py-4">
                    <h2 class="text-xl font-bold mb-3 flex items-center gap-2">
                        <span class="text-2xl">💬</span>
                        Description
                    </h2>
                    <p
                        class="text-base-content/80 leading-relaxed whitespace-pre-line">
                        {{ $jobListing->description }}</p>
                </div>

                {{-- Skills Required --}}
                @if (!empty($jobListing->skills_required))
                    <div class="py-4">
                        <h2
                            class="text-xl font-bold mb-3 flex items-center gap-2">
                            <span class="text-2xl">💡</span>
                            Skills Required
                        </h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($jobListing->skills_required as $skill)
                                <span
                                    class="badge badge-lg badge-outline badge-primary">{{ $skill }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Job Details Grid --}}
                <div class="py-4">
                    @include('freelancer.jobs.partials.show-job-details')
                </div>

                {{-- Action Buttons for Freelancer --}}
                @if (Auth::user()->role === 'freelancer')
                    <div class="divider"></div>
                    @include('freelancer.jobs.partials.action-buttons')
                @endif

            </div>
        </div>
        @if ($jobListing->status === 'completed' || $jobListing->status === 'cancelled')
            <div
                class="card bg-base-100 shadow-xl border {{ $application->status === 'completed' ? 'border-success' : 'border-error' }}">
                <div class="card-body">
                    <h2
                        class="card-title text-2xl mb-4 flex items-center gap-2">
                        <span
                            class="text-2xl">{{ $jobListing->status === 'completed' ? '🏆' : '❌' }}</span>
                        Job
                        {{ ucfirst($jobListing->status) }}
                    </h2>

                    <div class="flex flex-col md:flex-row items-start gap-6">
                        {{-- Avatar --}}
                        <div class="avatar self-center md:self-start">
                            <div
                                class="w-20 h-20 rounded-full ring {{ $jobListing->status === 'completed' ? 'ring-success' : 'ring-error' }} ring-offset-base-100 ring-offset-2">
                                <div
                                    class="flex items-center justify-center w-full h-full {{ $jobListing->status === 'completed' ? 'bg-success text-success-content' : 'bg-error text-error-content' }} text-3xl font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 w-full">
                            <div
                                class="flex flex-col sm:flex-row sm:items-center gap-2 mb-2">
                                <h3 class="text-xl font-bold">
                                    {{ $jobListing->status === 'completed' ? 'Completed by' : 'Cancelled Freelancer' }}
                                </h3>
                                <div
                                    class="badge {{ $jobListing->status === 'completed' ? 'badge-success' : 'badge-error' }} badge-lg">
                                    {{ ucfirst($jobListing->status) }}
                                </div>
                            </div>

                            <p
                                class="{{ $jobListing->status === 'completed' ? 'link-primary' : 'link-error' }} text-lg font-semibold mb-2 inline-block">
                                {{ Auth::user()->name }}
                            </p>

                            <div
                                class="alert {{ $jobListing->status === 'completed' ? 'alert-success' : 'alert-error' }} mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    class="stroke-current shrink-0 w-6 h-6">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                <span>{{ $jobListing->status === 'completed' ? 'Congratulations! This freelancer has completed your job.' : 'This freelancer was removed from the job.' }}</span>
                            </div>

                            {{-- Review Section --}}
                            @if ($jobListing->review)
                                <div class="card bg-base-200 shadow-sm mt-4">
                                    <div class="card-body">
                                        <h3
                                            class="card-title text-lg flex items-center gap-2">
                                            <span>⭐</span>
                                            Your Review
                                        </h3>
                                        <div class="space-y-2">
                                            <div
                                                class="flex items-center gap-2">
                                                <span
                                                    class="font-semibold">Rating:</span>
                                                <div class="rating rating-sm">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <input type="radio"
                                                            class="mask mask-star-2 bg-yellow-400"
                                                            disabled
                                                            {{ $i <= $jobListing->review->rating ? 'checked' : '' }} />
                                                    @endfor
                                                </div>
                                                <span
                                                    class="text-sm font-bold">{{ $jobListing->review->rating }}
                                                    /
                                                    5</span>
                                            </div>
                                            @if ($jobListing->review->comments)
                                                <div>
                                                    <span
                                                        class="font-semibold">Comments:</span>
                                                    <p
                                                        class="text-sm mt-1 text-base-content/80">
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
                                <div class="card bg-base-200 shadow-sm mt-4">
                                    <div class="card-body">
                                        <h3
                                            class="card-title text-lg flex items-center gap-2">
                                            <span>💰</span>
                                            Payment
                                            Information
                                        </h3>
                                        <div class="space-y-3">
                                            <div
                                                class="stat bg-base-100 rounded-lg">
                                                <div class="stat-title text-xs">
                                                    Amount
                                                    Paid
                                                </div>
                                                <div
                                                    class="stat-value text-success text-2xl">
                                                    ₱{{ number_format($jobListing->paymentRecord->price, 2) }}
                                                </div>
                                            </div>
                                            <div>
                                                <p class="font-semibold mb-2">
                                                    Proof of
                                                    Payment:
                                                </p>
                                                <a href="{{ Storage::url($jobListing->paymentRecord->proof_of_payment) }}"
                                                    target="_blank"
                                                    class="btn btn-secondary gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    View
                                                    Proof of
                                                    Payment
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
            form.action = `/freelancer/jobs/${jobId}/apply`;
            document.getElementById('apply_modal').showModal();
        }

        function closeApplyModal() {
            document.getElementById('apply_modal').close();
        }

        function openRemoveModal(jobId) {
            const form = document.getElementById('removeForm');
            form.action = `/freelancer/jobs/${jobId}/destroy`;
            document.getElementById('remove_modal').showModal();
        }

        function closeRemoveModal() {
            document.getElementById('remove_modal').close();
        }
    </script>

</x-layouts.app>
