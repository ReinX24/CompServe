<div
    class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4 sm:gap-6 pb-4 sm:pb-6 border-b-2 border-base-300">
    <!-- Left Section: Title & Badges -->
    <div class="flex-1">
        <div class="flex items-start gap-3 sm:gap-4">
            <!-- Icon Avatar -->
            <div class="avatar avatar-placeholder shrink-0">
                <div
                    class="bg-linear-to-br from-primary to-primary/60 text-primary-content rounded-xl w-12 h-12 sm:w-14 sm:h-14 shadow-lg ring-2 ring-primary/20 flex items-center justify-center">
                    <span class="text-xl sm:text-2xl">📝</span>
                </div>
            </div>

            <!-- Title & Meta Info -->
            <div class="flex-1 min-w-0">
                <h1
                    class="text-2xl sm:text-3xl lg:text-4xl font-bold text-base-content mb-2 sm:mb-3 leading-tight wrap-break-word">
                    {{ $jobListing->title }}
                </h1>

                <div class="flex flex-wrap gap-2 items-center">
                    @php
                        $statusColors = [
                            'open' => 'badge-success',
                            'in_progress' => 'badge-warning',
                            'completed' => 'badge-accent',
                            'cancelled' => 'badge-error',
                        ];
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

                        $statusColor =
                            $statusColors[$jobListing->status] ?? 'badge-ghost';
                        $emoji = $statusEmoji[$jobListing->status] ?? '📌';
                    @endphp

                    <!-- Category Badge -->
                    <div
                        class="badge badge-md sm:badge-lg bg-base-200/80 border-base-300 gap-1.5 sm:gap-2 hover:bg-base-300 transition-colors shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-3.5 w-3.5 sm:h-4 sm:w-4 opacity-70"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <span
                            class="text-xs sm:text-sm font-medium">{{ Str::headline($jobListing->category) }}</span>
                    </div>

                    <!-- Status Badge -->
                    <div
                        class="badge badge-md sm:badge-lg {{ $statusColor }} gap-1.5 sm:gap-2 shadow-md font-semibold border-0">
                        <span
                            class="text-sm sm:text-base">{{ $emoji }}</span>
                        <span
                            class="text-xs sm:text-sm">{{ ucfirst(str_replace('_', ' ', $jobListing->status)) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Section: Budget Card -->
    <div class="lg:text-right w-full lg:w-auto">
        <div
            class="stat bg-linear-to-br from-primary/10 via-primary/5 to-secondary/5 rounded-xl sm:rounded-2xl px-4 sm:px-6 py-3 sm:py-4 border-2 border-primary/20 shadow-lg hover:shadow-xl transition-all duration-200 hover:border-primary/30">
            <div
                class="flex lg:flex-col items-center lg:items-end justify-between lg:justify-start gap-3 lg:gap-0">
                <!-- Icon (Mobile Only) -->
                <div
                    class="w-10 h-10 bg-primary/20 rounded-full flex items-center justify-center lg:hidden shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-primary"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <!-- Budget Info -->
                <div class="flex-1 lg:flex-none">
                    <div
                        class="stat-title text-xs sm:text-sm opacity-70 mb-1 lg:mb-0.5 font-medium lg:text-right">
                        Budget
                    </div>
                    <div
                        class="stat-value text-primary text-xl sm:text-2xl lg:text-3xl font-bold flex items-baseline gap-1 lg:justify-end">
                        <span class="text-lg sm:text-xl lg:text-2xl">₱</span>
                        <span>{{ number_format($jobListing->budget, 2) }}</span>
                    </div>
                    <div
                        class="stat-desc text-xs sm:text-sm mt-0.5 lg:mt-1 flex items-center gap-1.5 lg:justify-end">
                        <span
                            class="w-2 h-2 rounded-full bg-primary/40 hidden sm:inline-block"></span>
                        <span
                            class="font-medium">{{ ucfirst($jobListing->budget_type) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Ensure responsive stat card */
    @media (max-width: 1024px) {
        .stat {
            min-width: 100%;
        }
    }

    /* Add subtle animation on hover */
    .stat:hover {
        transform: translateY(-2px);
    }

    /* Smooth transitions */
    .badge {
        transition: all 0.2s ease;
    }

    .badge:hover {
        transform: translateY(-1px);
    }
</style>
