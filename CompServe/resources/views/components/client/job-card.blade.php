@props(['job'])

<div
    class="card bg-base-200 border border-base-300 shadow-sm hover:shadow-sm hover:scale-[1.01] transition-transform duration-200 ease-in-out">
    <div class="card-body space-y-4">

        {{-- Header --}}
        <div class="flex justify-between items-start">
            <h2 class="card-title text-lg font-bold leading-tight">
                <a href="{{ route(Auth::user()->role === 'client' ? 'client.jobs.show' : 'freelancer.jobs.show', $job->id) }}"
                    class="link link-hover text-primary">

                    <!-- Mobile version (8 characters) -->
                    <span class="sm:hidden">
                        ✨ {{ Str::limit($job->title, 12) }}
                    </span>

                    <!-- Desktop/tablet version (24 characters) -->
                    <span class="hidden sm:inline">
                        ✨ {{ Str::limit($job->title, 24) }}
                    </span>
                </a>
            </h2>

            {{-- Status Badge --}}
            <div
                class="badge badge-outline p-2 text-xs
                {{ match ($job->status) {
                    'open' => 'badge-success',
                    'in_progress' => 'badge-warning',
                    'cancelled' => 'badge-error',
                    'completed' => 'badge-accent',
                    default => 'badge-outline',
                } }}">
                {{ match ($job->status) {
                    'open' => '🟢 Open',
                    'in_progress' => '⏳ In Progress',
                    'completed' => '🏆 Completed',
                    'cancelled' => '❌ Cancelled',
                    default => ucfirst(str_replace('_', ' ', $job->status)),
                } }}
            </div>
        </div>

        {{-- Client Info --}}
        <p class="text-sm text-base-content/70 mt-1">
            👤 Client: <span class="font-medium">{{ $job->client->name }}</span>
        </p>

        {{-- Short Description --}}
        <p class="text-sm text-base-content/70">
            📝 {{ Str::limit($job->description, 100) }}
        </p>

        {{-- Concise Job Details --}}
        <div class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
            <p>💰 <span class="font-medium">Budget:</span>
                ₱{{ number_format($job->budget, 2) }}</p>
            <p>🕒 <span class="font-medium">Type:</span>
                {{ ucfirst($job->duration_type) }}</p>
            <p>📂 <span class="font-medium">Category:</span>
                {{ preg_replace('/(?<!^)([A-Z])/', ' $1', $job->category) }}</p>

            <p>⏳ <span class="font-medium">Duration:</span>
                {{ $job->duration ?? 'N/A' }}</p>
            <p class="col-span-2">📍 <span class="font-medium">Location:</span>
                {{ $job->location ?? 'Remote' }}</p>

            <hr class="col-span-2">

            @if ($job->status === 'open')
                @php
                    $pending = $job->applicants
                        ->where('status', 'pending')
                        ->count();
                    $rejected = $job->applicants
                        ->where('status', 'rejected')
                        ->count();
                    $total = $job->applicants->count();
                @endphp

                <p>🟡 <span class="font-medium">Pending Applicants:</span>
                    {{ $pending }}</p>
                <p>❌ <span class="font-medium">Rejected Applicants:</span>
                    {{ $rejected }}</p>
                <p>👥 <span class="font-medium">Total Applicants:</span>
                    {{ $total }}</p>
            @endif
        </div>

        {{-- Footer --}}
        <div class="flex justify-between items-center pt-2">
            <p class="text-xs text-base-content/60">🕘 Posted
                {{ $job->created_at->diffForHumans() }}</p>

            <a href="{{ route(Auth::user()->role === 'client' ? 'client.jobs.show' : 'freelancer.jobs.show', $job->id) }}"
                class="btn btn-sm btn-secondary hover:scale-105 transition-transform duration-150">
                🔍 View
            </a>
        </div>

    </div>
</div>
