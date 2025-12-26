<div
    class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 pb-6 border-b border-base-300">
    <div class="flex-1">
        <div class="flex items-start gap-3">
            <div class="avatar avatar-placeholder">
                <div
                    class="bg-primary text-primary-content rounded-lg w-12 h-12">
                    <span class="text-xl">📝</span>
                </div>
            </div>
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-base-content mb-2">
                    {{ $jobListing->title }}</h1>
                <div class="flex flex-wrap gap-2 items-center text-sm">
                    <div class="badge badge-lg badge-ghost gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        {{ Str::headline($jobListing->category) }}
                    </div>
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
                    @endphp
                    <div
                        class="badge badge-lg {{ $statusColors[$jobListing->status] ?? 'badge-ghost' }} gap-2">
                        {{ $statusEmoji[$jobListing->status] ?? '📌' }}
                        {{ ucfirst(str_replace('_', ' ', $jobListing->status)) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-right">
        <div class="stat bg-primary/10 rounded-lg px-6 py-4">
            <div class="stat-title text-xs opacity-70">Budget
            </div>
            <div class="stat-value text-primary text-2xl">
                ₱{{ number_format($jobListing->budget, 2) }}
            </div>
            <div class="stat-desc text-xs">
                {{ ucfirst($jobListing->budget_type) }}</div>
        </div>
    </div>
</div>
