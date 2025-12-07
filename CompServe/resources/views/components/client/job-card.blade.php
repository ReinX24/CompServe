@props(['job'])

@php
    // Status configurations with enhanced styling
    $statusConfig = [
        'open' => [
            'badge' => 'badge-success',
            'text' => '🟢 Open',
            'border' => 'border-success/30',
            'gradient' => 'from-success/5 to-success/10',
            'icon_bg' => 'bg-success/10',
            'icon_color' => 'text-success',
            'emoji' => '🟢',
        ],
        'in_progress' => [
            'badge' => 'badge-warning',
            'text' => '⏳ In Progress',
            'border' => 'border-warning/30',
            'gradient' => 'from-warning/5 to-warning/10',
            'icon_bg' => 'bg-warning/10',
            'icon_color' => 'text-warning',
            'emoji' => '⏳',
        ],
        'completed' => [
            'badge' => 'badge-accent',
            'text' => '🏆 Completed',
            'border' => 'border-accent/30',
            'gradient' => 'from-accent/5 to-accent/10',
            'icon_bg' => 'bg-accent/10',
            'icon_color' => 'text-accent',
            'emoji' => '🏆',
        ],
        'cancelled' => [
            'badge' => 'badge-error',
            'text' => '❌ Cancelled',
            'border' => 'border-error/30',
            'gradient' => 'from-error/5 to-error/10',
            'icon_bg' => 'bg-error/10',
            'icon_color' => 'text-error',
            'emoji' => '❌',
        ],
    ];

    $config = $statusConfig[$job->status] ?? [
        'badge' => 'badge-outline',
        'text' => ucfirst(str_replace('_', ' ', $job->status)),
        'border' => 'border-base-300',
        'gradient' => 'from-base-200/5 to-base-200/10',
        'icon_bg' => 'bg-base-200/10',
        'icon_color' => 'text-base-content',
        'emoji' => '•',
    ];

    // Calculate applicant stats
    $pending = $job->applicants->where('status', 'pending')->count();
    $rejected = $job->applicants->where('status', 'rejected')->count();
    $total = $job->applicants->count();

    $routeName =
        Auth::user()->role === 'client'
            ? 'client.jobs.show'
            : 'freelancer.jobs.show';
@endphp

<div class="group relative">
    <!-- Glowing Effect on Hover -->
    <div
        class="absolute -inset-0.5 bg-linear-to-r {{ $config['gradient'] }} rounded-2xl opacity-0 group-hover:opacity-100 transition duration-500 blur">
    </div>

    <!-- Main Card -->
    <div
        class="relative bg-base-100 border-2 {{ $config['border'] }} shadow-lg hover:shadow-2xl transition-all duration-300 rounded-2xl overflow-hidden group-hover:scale-[1.02]">

        <!-- Status Ribbon (Top Right Corner) -->
        <div class="absolute top-0 right-0 z-10">
            <div class="relative">
                <div
                    class="absolute inset-0 bg-linear-to-br {{ $config['gradient'] }} blur-sm">
                </div>
                <span
                    class="relative badge {{ $config['badge'] }} badge-lg gap-1 rounded-bl-xl rounded-tr-2xl px-4 py-3 font-semibold shadow-lg border-0">
                    {{ $config['text'] }}
                </span>
            </div>
        </div>

        <!-- Decorative Top Border -->
        <div class="h-2 bg-linear-to-r {{ $config['gradient'] }}"></div>

        {{-- Card Body --}}
        <div class="card-body p-6 space-y-5">

            {{-- Header Section --}}
            <div class="pt-8">
                <a href="{{ route($routeName, $job->id) }}"
                    class="block group/title">
                    <h2
                        class="text-xl font-bold text-base-content group-hover/title:text-primary transition-colors duration-200 leading-tight line-clamp-2 mb-3">
                        {{ $job->title }}
                    </h2>
                </a>

                {{-- Client Info with Enhanced Styling --}}
                <div
                    class="flex items-center gap-3 bg-base-200/30 rounded-xl p-3 border border-base-300/50">
                    <div class="avatar placeholder">
                        <div
                            class="bg-linear-to-br from-primary to-primary/60 text-white rounded-full w-10 h-10 flex items-center justify-center text-sm font-bold shadow-md ring-2 ring-primary/20">
                            {{ strtoupper(substr($job->client->name, 0, 2)) }}
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-base-content/50 mb-0.5">Posted by
                        </p>
                        <p class="text-sm font-semibold text-base-content">
                            {{ $job->client->name }}</p>
                    </div>
                </div>
            </div>

            {{-- Description --}}
            <div
                class="bg-base-200/50 rounded-xl p-4 border border-base-300/50">
                <p
                    class="text-sm text-base-content/80 leading-relaxed line-clamp-3">
                    {{ $job->description }}
                </p>
            </div>

            {{-- Key Details in Enhanced Pills --}}
            <div class="flex flex-wrap gap-2">
                <div
                    class="badge badge-lg gap-2 bg-success/10 text-success border-success/30 shadow-sm hover:shadow-md hover:scale-105 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="w-4 h-4">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span
                        class="font-bold">₱{{ number_format($job->budget, 2) }}</span>
                </div>

                <div
                    class="badge badge-lg gap-2 bg-primary/10 text-primary border-primary/30 shadow-sm hover:shadow-md hover:scale-105 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="w-4 h-4">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span
                        class="font-semibold">{{ ucfirst($job->duration_type) }}</span>
                </div>

                <div
                    class="badge badge-lg gap-2 bg-secondary/10 text-secondary border-secondary/30 shadow-sm hover:shadow-md hover:scale-105 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="w-4 h-4">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 6h.008v.008H6V6Z" />
                    </svg>
                    <span
                        class="font-semibold">{{ preg_replace('/(?<!^)([A-Z])/', ' $1', $job->category) }}</span>
                </div>
            </div>

            {{-- Detailed Information Grid --}}
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-3">
                    <div
                        class="flex items-start gap-3 bg-base-200/30 rounded-lg p-3 border border-base-300/50">
                        <div class="shrink-0 mt-0.5">
                            <div class="bg-primary/10 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="w-4 h-4 text-primary">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-base-content/60 mb-1">
                                Duration</p>
                            <p
                                class="text-sm font-bold text-base-content truncate">
                                {{ $job->duration ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div
                        class="flex items-start gap-3 bg-base-200/30 rounded-lg p-3 border border-base-300/50">
                        <div class="shrink-0 mt-0.5">
                            <div class="bg-primary/10 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="w-4 h-4 text-primary">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-base-content/60 mb-1">
                                Location</p>
                            <p
                                class="text-sm font-bold text-base-content truncate">
                                {{ $job->location ?? 'Remote' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Applicants Stats (Only for Open Jobs) --}}
                @if ($job->status === 'open')
                    <div
                        class="bg-linear-to-br from-base-200/30 to-base-200/50 rounded-xl p-4 border border-base-300/50">
                        <div class="flex items-center gap-2 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="w-5 h-5 text-primary">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                            <h4 class="text-sm font-bold text-base-content">
                                Applicants</h4>
                        </div>

                        <div class="grid grid-cols-3 gap-2">
                            <div
                                class="bg-base-100 rounded-lg p-3 border-2 border-warning/30 hover:border-warning hover:shadow-md transition-all duration-200">
                                <div
                                    class="flex items-center justify-center mb-1">
                                    <span
                                        class="text-2xl font-bold text-warning">{{ $pending }}</span>
                                </div>
                                <div
                                    class="text-xs text-center text-base-content/60 font-medium">
                                    Pending</div>
                            </div>

                            <div
                                class="bg-base-100 rounded-lg p-3 border-2 border-error/30 hover:border-error hover:shadow-md transition-all duration-200">
                                <div
                                    class="flex items-center justify-center mb-1">
                                    <span
                                        class="text-2xl font-bold text-error">{{ $rejected }}</span>
                                </div>
                                <div
                                    class="text-xs text-center text-base-content/60 font-medium">
                                    Rejected</div>
                            </div>

                            <div
                                class="bg-base-100 rounded-lg p-3 border-2 border-primary/30 hover:border-primary hover:shadow-md transition-all duration-200">
                                <div
                                    class="flex items-center justify-center mb-1">
                                    <span
                                        class="text-2xl font-bold text-primary">{{ $total }}</span>
                                </div>
                                <div
                                    class="text-xs text-center text-base-content/60 font-medium">
                                    Total</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Footer --}}
            <div
                class="flex justify-between items-center pt-4 border-t border-base-300/50">
                <div
                    class="flex items-center gap-2 text-xs text-base-content/50">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="w-4 h-4">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span>Posted {{ $job->created_at->diffForHumans() }}</span>
                </div>

                <a href="{{ route($routeName, $job->id) }}"
                    class="btn btn-primary btn-sm gap-2 shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 group/btn">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="w-4 h-4 group-hover/btn:scale-110 transition-transform duration-200">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span class="font-medium">View Details</span>
                </a>
            </div>

        </div>
    </div>
</div>

<style>
    /* Line clamp utilities */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
