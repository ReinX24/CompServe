<x-layouts.app>
    <div class="breadcrumbs text-sm mb-4">
        <ul class="text-base-content/70">
            <li><a href="{{ route('dashboard') }}"
                    class="hover:text-primary">Dashboard</a></li>
            <li><a href="{{ route('freelancer.gigs.index') }}"
                    class="hover:text-primary">All Gigs</a></li>
            <li class="text-primary font-semibold">{{ $jobListing->title }}</li>
        </ul>
    </div>

    <div class="max-w-4xl mx-auto bg-base-200 text-base shadow rounded-lg p-6">

        {{-- Success Message --}}
        @session('success')
            <div class="mb-4">
                <div role="alert"
                    class="alert alert-success alert-soft text-lg flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 shrink-0 stroke-current"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endsession

        {{-- Header: Job Title & Info --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold my-2">📝 {{ $jobListing->title }}</h1>
            <p class="text-sm my-2"><span class="font-medium">📂
                    Category:</span> {{ Str::headline($jobListing->category) }}
            </p>
            <p class="text-sm my-2"><span class="font-medium">👤 Posted
                    by:</span> {{ $jobListing->client->name }}</p>

            @php
                $statusColors = [
                    'open' => 'badge badge-success badge-outline',
                    'in_progress' => 'badge badge-warning badge-outline',
                    'completed' => 'badge badge-accent badge-outline',
                    'cancelled' => 'badge badge-error badge-outline',
                ];
            @endphp

            @php
                $statusEmoji = [
                    'open' => '🟢',
                    'available' => '🟢',
                    'in_progress' => '⏳',
                    'pending' => '🕒',
                    'completed' => '✅',
                    'cancelled' => '❌',
                    'on_hold' => '⏸️',
                    'rejected' => '🚫',
                ];
            @endphp

            <p class="text-sm font-medium">
                Status:
                <span
                    class="{{ $statusColors[$jobListing->status] ?? 'badge' }}">
                    {{ $statusEmoji[$jobListing->status] ?? '📌' }}
                    {{ ucfirst(str_replace('_', ' ', $jobListing->status)) }}
                </span>
            </p>
        </div>

        {{-- Description --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">💬 Description</h2>
            <p class="leading-relaxed">{{ $jobListing->description }}</p>
        </div>

        {{-- Skills Required --}}
        @if (!empty($jobListing->skills_required))
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">💡 Skills Required</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach ($jobListing->skills_required as $skill)
                        <span
                            class="badge badge-outline border-primary text-primary">{{ $skill }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Job Details --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">📌 Job Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm font-semibold">🕒 Type</p>
                    <p>{{ $jobListing->duration_type === 'gig' ? 'Gig (Short-term)' : 'Contract (Long-term)' }}
                    </p>
                </div>
                <div>
                    <p class="text-sm font-semibold">⏳ Duration</p>
                    <p>{{ $jobListing->duration ?? 'Not specified' }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold">💰 Budget Type</p>
                    <p>{{ ucfirst($jobListing->budget_type) }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold">💵 Budget</p>
                    <p class="font-bold">
                        ₱{{ number_format($jobListing->budget, 2) }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold">📍 Location</p>
                    <p>{{ $jobListing->location ?? 'Remote' }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold">📅 Deadline</p>
                    <p>{{ $jobListing->deadline ? $jobListing->deadline->format('M d, Y') : 'No deadline' }}
                    </p>
                </div>
                <div>
                    <p class="text-sm font-semibold">📤 Posted On</p>
                    <p>{{ $jobListing->created_at->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold">🔄 Last Updated</p>
                    <p>{{ $jobListing->updated_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Action Buttons for Freelancer --}}
        <div
            class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-3">
            @if (Auth::user()->role === 'freelancer')
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
                        <button class="btn btn-success"
                            disabled
                            onclick="openApplyModal({{ $jobListing->id }})">🕐
                            Applied</button>
                        <button class="btn btn-outline btn-error"
                            onclick="openRemoveModal({{ $jobListing->id }})">❌
                            Remove</button>
                    @elseif ($application->status === 'accepted')
                        <button class="btn btn-success"
                            disabled>✅ Accepted</button>
                        <button class="btn btn-outline btn-error"
                            onclick="openRemoveModal({{ $jobListing->id }})">❌
                            Cancel</button>
                    @elseif ($application->status === 'completed')
                        <button class="btn btn-success"
                            disabled>🏆 Completed</button>
                    @elseif ($application->status === 'rejected')
                        <button class="btn btn-outline btn-error"
                            disabled>❌ Rejected</button>
                    @elseif ($application->status === 'cancelled')
                        <button class="btn btn-error"
                            disabled>❌ Cancelled</button>
                    @endif
                @else
                    <button class="btn btn-primary"
                        onclick="openApplyModal({{ $jobListing->id }})">📝
                        Apply</button>
                @endif
            @endif
        </div>

    </div>

    {{-- Apply Confirmation Modal --}}
    <dialog id="apply_modal"
        class="modal">
        <form method="POST"
            id="applyForm"
            class="modal-box">
            @csrf
            <input type="hidden"
                name="jobId"
                id="applyJobId">
            <h3 class="font-bold text-lg">Apply for this Job?</h3>
            <p class="py-4">Are you sure you want to <strong>apply</strong>
                for this job?</p>
            <div class="modal-action">
                <button class="btn btn-primary">Yes, Apply</button>
                <button type="button"
                    class="btn"
                    onclick="closeApplyModal()">Cancel</button>
            </div>
        </form>
    </dialog>

    {{-- Remove / Cancel Confirmation Modal --}}
    <dialog id="remove_modal"
        class="modal">
        <form method="POST"
            id="removeForm"
            class="modal-box">
            @csrf
            @method('DELETE')
            <h3 class="font-bold text-lg">Remove Application?</h3>
            <p class="py-4">Are you sure you want to
                <strong>remove/cancel</strong> your application?
            </p>
            <div class="modal-action">
                <button class="btn btn-error">Yes, Remove</button>
                <button type="button"
                    class="btn"
                    onclick="closeRemoveModal()">Cancel</button>
            </div>
        </form>
    </dialog>

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
