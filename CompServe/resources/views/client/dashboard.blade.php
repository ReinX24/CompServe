<x-layouts.app>
    <div
        class="min-h-screen bg-linear-to-br from-base-200 via-base-100 to-base-200 py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <span class="text-5xl">📋</span>
                    <h1
                        class="text-4xl font-bold bg-linear-to-r from-secondary to-accent bg-clip-text text-transparent">
                        {{ __('Client Dashboard') }}
                    </h1>
                </div>
                <p class="text-base-content/70 text-lg ml-16">Welcome back!
                    Here's an overview of your activities.</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Received Applications Card -->
                <div
                    class="card bg-linear-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-blue-200 dark:border-blue-800 group">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p
                                    class="text-sm font-medium text-base-content/70 mb-2">
                                    {{ __('Received Applications') }}
                                </p>
                                <p
                                    class="text-4xl font-bold text-base-content mb-3">
                                    {{ $applicationCount ?? '--' }}
                                </p>
                                <div class="badge badge-blue badge-sm gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-3 w-3"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                    Active
                                </div>
                            </div>
                            <div
                                class="bg-blue-500 dark:bg-blue-600 p-4 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    class="h-8 w-8 text-white"
                                    stroke-width="2"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                </svg>
                            </div>
                        </div>
                        <div
                            class="mt-4 pt-4 border-t border-blue-200 dark:border-blue-800">
                            <p class="text-xs text-base-content/60">Total
                                applications received</p>
                        </div>
                    </div>
                </div>

                <!-- Posted Gigs Card -->
                <div
                    class="card bg-linear-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-green-200 dark:border-green-800 group">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p
                                    class="text-sm font-medium text-base-content/70 mb-2">
                                    {{ __('Posted Gigs / Contracts') }}
                                </p>
                                <p
                                    class="text-4xl font-bold text-base-content mb-3">
                                    {{ $postedCount ?? '--' }}
                                </p>
                                <div class="badge badge-success badge-sm gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-3 w-3"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Published
                                </div>
                            </div>
                            <div
                                class="bg-green-500 dark:bg-green-600 p-4 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    class="h-8 w-8 text-white"
                                    stroke-width="2"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                </svg>
                            </div>
                        </div>
                        <div
                            class="mt-4 pt-4 border-t border-green-200 dark:border-green-800">
                            <p class="text-xs text-base-content/60">Your active
                                job postings</p>
                        </div>
                    </div>
                </div>

                <!-- In Progress Card -->
                <div
                    class="card bg-linear-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-purple-200 dark:border-purple-800 group">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p
                                    class="text-sm font-medium text-base-content/70 mb-2">
                                    {{ __('In-progress Gigs / Contracts') }}
                                </p>
                                <p
                                    class="text-4xl font-bold text-base-content mb-3">
                                    {{ $inProgressCount ?? '--' }}
                                </p>
                                <div class="badge badge-purple badge-sm gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-3 w-3 animate-spin"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Ongoing
                                </div>
                            </div>
                            <div
                                class="bg-purple-500 dark:bg-purple-600 p-4 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8 text-white"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                        </div>
                        <div
                            class="mt-4 pt-4 border-t border-purple-200 dark:border-purple-800">
                            <p class="text-xs text-base-content/60">Currently in
                                development</p>
                        </div>
                    </div>
                </div>

                <!-- Completed Card -->
                <div
                    class="card bg-linear-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-orange-200 dark:border-orange-800 group">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p
                                    class="text-sm font-medium text-base-content/70 mb-2">
                                    {{ __('Completed Gigs / Contracts') }}
                                </p>
                                <p
                                    class="text-4xl font-bold text-base-content mb-3">
                                    {{ $completedCount ?? '--' }}
                                </p>
                                <div class="badge badge-warning badge-sm gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-3 w-3"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                    </svg>
                                    Done
                                </div>
                            </div>
                            <div
                                class="bg-orange-500 dark:bg-orange-600 p-4 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8 text-white"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                        </div>
                        <div
                            class="mt-4 pt-4 border-t border-orange-200 dark:border-orange-800">
                            <p class="text-xs text-base-content/60">
                                Successfully finished projects</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Summary -->
            <div class="mt-8 card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2
                        class="card-title text-2xl mb-4 flex items-center gap-2">
                        <span class="text-3xl">📊</span>
                        Quick Overview
                    </h2>
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="stat bg-base-200 rounded-lg">
                            <div class="stat-title">Total Activity</div>
                            <div class="stat-value text-primary">
                                {{ ($applicationCount ?? 0) + ($postedCount ?? 0) + ($inProgressCount ?? 0) + ($completedCount ?? 0) }}
                            </div>
                            <div class="stat-desc">All-time engagement</div>
                        </div>
                        <div class="stat bg-base-200 rounded-lg">
                            <div class="stat-title">Active Projects</div>
                            <div class="stat-value text-secondary">
                                {{ ($postedCount ?? 0) + ($inProgressCount ?? 0) }}
                            </div>
                            <div class="stat-desc">Current workload</div>
                        </div>
                        <div class="stat bg-base-200 rounded-lg">
                            <div class="stat-title">Success Rate</div>
                            <div class="stat-value text-accent">
                                @php
                                    $total =
                                        ($postedCount ?? 0) +
                                        ($inProgressCount ?? 0) +
                                        ($completedCount ?? 0);
                                    $rate =
                                        $total > 0
                                            ? round(
                                                (($completedCount ?? 0) /
                                                    $total) *
                                                    100,
                                            )
                                            : 0;
                                @endphp
                                {{ $rate }}%
                            </div>
                            <div class="stat-desc">Completion ratio</div>
                        </div>
                        <div class="stat bg-base-200 rounded-lg">
                            <div class="stat-title">Pending Review</div>
                            <div class="stat-value text-info">
                                {{ $applicationCount ?? 0 }}</div>
                            <div class="stat-desc">Awaiting response</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
