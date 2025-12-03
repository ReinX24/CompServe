@props(['job'])

<div
    class="card bg-base-100 border-2 border-base-200 shadow-sm hover:shadow-md hover:border-primary-content transition-all duration-300 overflow-hidden group">
    <div class="card-body p-6 space-y-4">

        {{-- Header Section --}}
        <div class="flex justify-between items-start gap-3">
            <div class="flex-1 min-w-0">
                <a href="{{ route(Auth::user()->role === 'client' ? 'client.jobs.show' : 'freelancer.jobs.show', $job->id) }}"
                    class="block group/title">
                    <h2
                        class="text-xl font-bold text-base-content group-hover/title:text-primary transition-colors leading-tight">
                        <!-- Mobile version -->
                        <span class="sm:hidden">
                            {{ Str::limit($job->title, 30) }}
                        </span>
                        <!-- Desktop/tablet version -->
                        <span class="hidden sm:inline">
                            {{ Str::limit($job->title, 50) }}
                        </span>
                    </h2>
                </a>

                {{-- Client Info --}}
                <div class="flex items-center gap-2 mt-2">
                    <div class="avatar placeholder">
                        <div
                            class="bg-primary/10 text-primary rounded-full w-8 h-8 flex items-center justify-center text-xs font-bold">
                            {{ strtoupper(substr($job->client->name, 0, 2)) }}
                        </div>
                    </div>
                    <span
                        class="text-sm text-base-content/70">{{ $job->client->name }}</span>
                </div>
            </div>

            {{-- Status Badge --}}
            <div
                class="badge badge-lg badge-outline gap-2 font-semibold shadow-sm
                {{ match ($job->status) {
                    'open' => 'badge-success',
                    'in_progress' => 'badge-warning',
                    'cancelled' => 'badge-error',
                    'completed' => 'badge-accent',
                    default => 'badge-outline',
                } }}">
                <span class="text-base">
                    {{ match ($job->status) {
                        'open' => '🟢',
                        'in_progress' => '⏳',
                        'completed' => '🏆',
                        'cancelled' => '❌',
                        default => '•',
                    } }}
                </span>
                <span class="hidden sm:inline">
                    {{ match ($job->status) {
                        'open' => 'Open',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        default => ucfirst(str_replace('_', ' ', $job->status)),
                    } }}
                </span>
            </div>
        </div>

        {{-- Description --}}
        <p class="text-sm text-base-content/70 leading-relaxed line-clamp-2">
            {{ $job->description }}
        </p>

        {{-- Key Details in Pills --}}
        <div class="flex flex-wrap gap-2">
            <div class="badge badge-outline badge-success badge-lg gap-2">
                {{-- <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg> --}}
                ₱{{ number_format($job->budget, 2) }}
            </div>

            <div class="badge badge-outline badge-primary badge-lg gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                {{ ucfirst($job->duration_type) }}
            </div>

            <div class="badge badge-outline badge-secondary badge-lg gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 6h.008v.008H6V6Z" />
                </svg>
                {{ preg_replace('/(?<!^)([A-Z])/', ' $1', $job->category) }}
            </div>
        </div>

        {{-- Detailed Information Grid --}}
        <div class="bg-base-200/50 rounded-lg p-4 space-y-3">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                <div class="flex items-start gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-5 h-5 text-primary shrink-0 mt-0.5">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    <div>
                        <span class="text-base-content/60">Duration</span>
                        <p class="font-semibold text-base-content">
                            {{ $job->duration ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-5 h-5 text-primary shrink-0 mt-0.5">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    <div>
                        <span class="text-base-content/60">Location</span>
                        <p class="font-semibold text-base-content">
                            {{ $job->location ?? 'Remote' }}</p>
                    </div>
                </div>
            </div>

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

                <div class="divider my-2">Applicants</div>

                <div class="grid grid-cols-3 gap-2 text-center">
                    <div
                        class="bg-base-100 rounded-lg p-3 border border-warning/30">
                        <div class="text-2xl font-bold text-warning">
                            {{ $pending }}</div>
                        <div class="text-xs text-base-content/60 mt-1">Pending
                        </div>
                    </div>
                    <div
                        class="bg-base-100 rounded-lg p-3 border border-error/30">
                        <div class="text-2xl font-bold text-error">
                            {{ $rejected }}</div>
                        <div class="text-xs text-base-content/60 mt-1">Rejected
                        </div>
                    </div>
                    <div
                        class="bg-base-100 rounded-lg p-3 border border-primary/30">
                        <div class="text-2xl font-bold text-primary">
                            {{ $total }}</div>
                        <div class="text-xs text-base-content/60 mt-1">Total
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Footer --}}
        <div
            class="flex justify-between items-center pt-2 border-t border-base-200">
            <div class="flex items-center gap-2 text-xs text-base-content/60">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>Posted {{ $job->created_at->diffForHumans() }}</span>
            </div>

            <a href="{{ route(Auth::user()->role === 'client' ? 'client.jobs.show' : 'freelancer.jobs.show', $job->id) }}"
                class="btn btn-primary btn-sm gap-2 shadow-md hover:shadow-lg hover:scale-105 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                View Details
            </a>
        </div>

    </div>
</div>

<style>
    /* Line clamp utility for description */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
