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

            <!-- Gigs Section -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                    <span class="text-3xl">⚡</span>
                    Gigs
                </h2>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Posted Gigs Card -->
                    <a href="{{ route('client.gigs.open') }}">
                        <div
                            class="card bg-linear-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-green-200 dark:border-green-800 group">
                            <div class="card-body">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p
                                            class="text-sm font-medium text-base-content/70 mb-2">
                                            {{ __('Open Gigs') }}
                                        </p>
                                        <p
                                            class="text-4xl font-bold text-base-content mb-3">
                                            {{ $postedGigsCount ?? '--' }}
                                        </p>
                                        <div
                                            class="badge badge-success badge-sm gap-1">
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
                                    <p class="text-xs text-base-content/60">
                                        Active
                                        gig postings</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- In Progress Gigs Card -->
                    <a href="{{ route('client.gigs.in_progress') }}">
                        <div
                            class="card bg-linear-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-purple-200 dark:border-purple-800 group">
                            <div class="card-body">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p
                                            class="text-sm font-medium text-base-content/70 mb-2">
                                            {{ __('In-Progress Gigs') }}
                                        </p>
                                        <p
                                            class="text-4xl font-bold text-base-content mb-3">
                                            {{ $inProgressGigsCount ?? '--' }}
                                        </p>
                                        <div
                                            class="badge badge-purple badge-sm gap-1">
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
                                    <p class="text-xs text-base-content/60">
                                        Currently in progress</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Completed Gigs Card -->
                    <a href="{{ route('client.gigs.completed') }}">
                        <div
                            class="card bg-linear-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-orange-200 dark:border-orange-800 group">
                            <div class="card-body">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p
                                            class="text-sm font-medium text-base-content/70 mb-2">
                                            {{ __('Completed Gigs') }}
                                        </p>
                                        <p
                                            class="text-4xl font-bold text-base-content mb-3">
                                            {{ $completedGigsCount ?? '--' }}
                                        </p>
                                        <div
                                            class="badge badge-warning badge-sm gap-1">
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
                                        Successfully finished gigs</p>
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
            </div>

            <!-- Contracts Section -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                    <span class="text-3xl">📄</span>
                    Contracts
                </h2>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Posted Contracts Card -->
                    <a href="{{ route('client.contracts.open') }}">
                        <div
                            class="card bg-linear-to-br from-cyan-50 to-cyan-100 dark:from-cyan-900/20 dark:to-cyan-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-cyan-200 dark:border-cyan-800 group">
                            <div class="card-body">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p
                                            class="text-sm font-medium text-base-content/70 mb-2">
                                            {{ __('Open Contracts') }}
                                        </p>
                                        <p
                                            class="text-4xl font-bold text-base-content mb-3">
                                            {{ $postedContractsCount ?? '--' }}
                                        </p>
                                        <div
                                            class="badge badge-info badge-sm gap-1">
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
                                        class="bg-cyan-500 dark:bg-cyan-600 p-4 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            class="h-8 w-8 text-white"
                                            stroke-width="2"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                    </div>
                                </div>
                                <div
                                    class="mt-4 pt-4 border-t border-cyan-200 dark:border-cyan-800">
                                    <p class="text-xs text-base-content/60">
                                        Active
                                        contract postings</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- In Progress Contracts Card -->
                    <a href="{{ route('client.contracts.in_progress') }}">
                        <div
                            class="card bg-linear-to-br from-indigo-50 to-indigo-100 dark:from-indigo-900/20 dark:to-indigo-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-indigo-200 dark:border-indigo-800 group">
                            <div class="card-body">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p
                                            class="text-sm font-medium text-base-content/70 mb-2">
                                            {{ __('In-Progress Contracts') }}
                                        </p>
                                        <p
                                            class="text-4xl font-bold text-base-content mb-3">
                                            {{ $inProgressContractsCount ?? '--' }}
                                        </p>
                                        <div
                                            class="badge badge-accent badge-sm gap-1">
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
                                        class="bg-indigo-500 dark:bg-indigo-600 p-4 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-8 w-8 text-white"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </div>
                                </div>
                                <div
                                    class="mt-4 pt-4 border-t border-indigo-200 dark:border-indigo-800">
                                    <p class="text-xs text-base-content/60">
                                        Currently active</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Completed Contracts Card -->
                    <a href="{{ route('client.contracts.completed') }}">
                        <div
                            class="card bg-linear-to-br from-emerald-50 to-emerald-100 dark:from-emerald-900/20 dark:to-emerald-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-emerald-200 dark:border-emerald-800 group">
                            <div class="card-body">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p
                                            class="text-sm font-medium text-base-content/70 mb-2">
                                            {{ __('Completed Contracts') }}
                                        </p>
                                        <p
                                            class="text-4xl font-bold text-base-content mb-3">
                                            {{ $completedContractsCount ?? '--' }}
                                        </p>
                                        <div
                                            class="badge badge-success badge-sm gap-1">
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
                                        class="bg-emerald-500 dark:bg-emerald-600 p-4 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-8 w-8 text-white"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                        </svg>
                                    </div>
                                </div>
                                <div
                                    class="mt-4 pt-4 border-t border-emerald-200 dark:border-emerald-800">
                                    <p class="text-xs text-base-content/60">
                                        Successfully finished</p>
                                </div>
                            </div>
                        </div>
                    </a>

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
                            <div class="stat-title">Total Gigs</div>
                            <div class="stat-value text-primary">
                                {{ ($postedGigsCount ?? 0) + ($inProgressGigsCount ?? 0) + ($completedGigsCount ?? 0) }}
                            </div>
                            <div class="stat-desc">All gig activity</div>
                        </div>
                        <div class="stat bg-base-200 rounded-lg">
                            <div class="stat-title">Total Contracts</div>
                            <div class="stat-value text-secondary">
                                {{ ($postedContractsCount ?? 0) + ($inProgressContractsCount ?? 0) + ($completedContractsCount ?? 0) }}
                            </div>
                            <div class="stat-desc">All contract activity</div>
                        </div>
                        <div class="stat bg-base-200 rounded-lg">
                            <div class="stat-title">Gig Success Rate</div>
                            <div class="stat-value text-accent">
                                @php
                                    $totalGigs =
                                        ($postedGigsCount ?? 0) +
                                        ($inProgressGigsCount ?? 0) +
                                        ($completedGigsCount ?? 0);
                                    $gigRate =
                                        $totalGigs > 0
                                            ? round(
                                                (($completedGigsCount ?? 0) /
                                                    $totalGigs) *
                                                    100,
                                            )
                                            : 0;
                                @endphp
                                {{ $gigRate }}%
                            </div>
                            <div class="stat-desc">Gig completion ratio</div>
                        </div>
                        <div class="stat bg-base-200 rounded-lg">
                            <div class="stat-title">Contract Success Rate</div>
                            <div class="stat-value text-info">
                                @php
                                    $totalContracts =
                                        ($postedContractsCount ?? 0) +
                                        ($inProgressContractsCount ?? 0) +
                                        ($completedContractsCount ?? 0);
                                    $contractRate =
                                        $totalContracts > 0
                                            ? round(
                                                (($completedContractsCount ??
                                                    0) /
                                                    $totalContracts) *
                                                    100,
                                            )
                                            : 0;
                                @endphp
                                {{ $contractRate }}%
                            </div>
                            <div class="stat-desc">Contract completion ratio
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
