<x-layouts.app>
    <div
        class="min-h-screen bg-gradient-to-br from-base-200 via-base-100 to-base-200 py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <span class="text-5xl">💼</span>
                    <h1
                        class="text-4xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                        {{ __('Freelancer Dashboard') }}
                    </h1>
                </div>
                <p class="text-base-content/70 text-lg ml-16">Welcome back!
                    Here's your work overview and opportunities.</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Available Gigs Card -->
                <div
                    class="card bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-blue-200 dark:border-blue-800 group">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p
                                    class="text-sm font-medium text-base-content/70 mb-2">
                                    {{ __('Available Gigs / Contracts') }}
                                </p>
                                <p
                                    class="text-4xl font-bold text-base-content mb-3">
                                    {{ $availableJobsCount ?? '--' }}
                                </p>
                                <div class="badge badge-info badge-sm gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-3 w-3"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Browse
                                </div>
                            </div>
                            <div
                                class="bg-blue-500 dark:bg-blue-600 p-4 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8 text-white"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                                </svg>
                            </div>
                        </div>
                        <div
                            class="mt-4 pt-4 border-t border-blue-200 dark:border-blue-800">
                            <p class="text-xs text-base-content/60">New
                                opportunities waiting</p>
                        </div>
                    </div>
                </div>

                <!-- Applied Gigs Card -->
                <div
                    class="card bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-green-200 dark:border-green-800 group">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p
                                    class="text-sm font-medium text-base-content/70 mb-2">
                                    {{ __('Applied Gigs / Contracts') }}
                                </p>
                                <p
                                    class="text-4xl font-bold text-base-content mb-3">
                                    {{ $appliedJobsCount ?? '--' }}
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
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Pending
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
                                        d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                </svg>
                            </div>
                        </div>
                        <div
                            class="mt-4 pt-4 border-t border-green-200 dark:border-green-800">
                            <p class="text-xs text-base-content/60">Your active
                                applications</p>
                        </div>
                    </div>
                </div>

                <!-- In Progress Card -->
                <div
                    class="card bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-purple-200 dark:border-purple-800 group">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p
                                    class="text-sm font-medium text-base-content/70 mb-2">
                                    {{ __('In-progress Gigs / Contracts') }}
                                </p>
                                <p
                                    class="text-4xl font-bold text-base-content mb-3">
                                    {{ $currentJobsCount ?? '--' }}
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
                                    Active
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
                                        d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
                                </svg>
                            </div>
                        </div>
                        <div
                            class="mt-4 pt-4 border-t border-purple-200 dark:border-purple-800">
                            <p class="text-xs text-base-content/60">Work in
                                progress</p>
                        </div>
                    </div>
                </div>

                <!-- Completed Card -->
                <div
                    class="card bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-orange-200 dark:border-orange-800 group">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p
                                    class="text-sm font-medium text-base-content/70 mb-2">
                                    {{ __('Completed Gigs / Contracts') }}
                                </p>
                                <p
                                    class="text-4xl font-bold text-base-content mb-3">
                                    {{ $completedJobsCount ?? '--' }}
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
                                Successfully delivered</p>
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
                        Performance Overview
                    </h2>
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="stat bg-base-200 rounded-lg">
                            <div class="stat-title">Total Jobs</div>
                            <div class="stat-value text-primary">
                                {{ ($appliedJobsCount ?? 0) + ($currentJobsCount ?? 0) + ($completedJobsCount ?? 0) }}
                            </div>
                            <div class="stat-desc">Your career activity</div>
                        </div>
                        <div class="stat bg-base-200 rounded-lg">
                            <div class="stat-title">Active Work</div>
                            <div class="stat-value text-secondary">
                                {{ ($appliedJobsCount ?? 0) + ($currentJobsCount ?? 0) }}
                            </div>
                            <div class="stat-desc">Pending & ongoing</div>
                        </div>
                        <div class="stat bg-base-200 rounded-lg">
                            <div class="stat-title">Success Rate</div>
                            <div class="stat-value text-accent">
                                @php
                                    $total =
                                        ($appliedJobsCount ?? 0) +
                                        ($currentJobsCount ?? 0) +
                                        ($completedJobsCount ?? 0);
                                    $rate =
                                        $total > 0
                                            ? round(
                                                (($completedJobsCount ?? 0) /
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
                            <div class="stat-title">New Opportunities</div>
                            <div class="stat-value text-info">
                                {{ $availableJobsCount ?? 0 }}</div>
                            <div class="stat-desc">Ready to apply</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Action Banner -->
            <div
                class="mt-8 card bg-gradient-to-r from-primary to-secondary shadow-xl overflow-hidden">
                <div class="card-body">
                    <div
                        class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="text-center md:text-left">
                            <h3
                                class="text-2xl font-bold text-primary-content mb-2">
                                🚀 Ready to grow your career?
                            </h3>
                            <p class="text-primary-content/80">
                                {{ $availableJobsCount ?? 0 }} new
                                opportunities are waiting for you. Start
                                browsing and applying today!
                            </p>
                        </div>
                        <a href="{{ route('freelancer.gigs.index') }}"
                            class="btn btn-lg bg-white text-primary hover:bg-base-200 border-0 shadow-lg gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Browse Gigs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
