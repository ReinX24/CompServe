<x-layouts.app>
    <div
        class="min-h-screen bg-linear-to-br from-base-200 via-base-100 to-base-200 py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <span class="text-5xl">💼</span>
                    <h1 class="text-4xl font-bold text-primary">
                        {{ __('Freelancer Dashboard') }}
                    </h1>
                </div>
                <p class="text-base-content/70 text-lg ml-16">Welcome back!
                    Here's your work overview and opportunities.</p>
            </div>

            <!-- Gigs Section -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                    <span class="text-3xl">⚡</span>
                    Gigs Overview
                </h2>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Available Gigs -->
                    <a href="{{ route('freelancer.gigs.open') }}">
                        <div
                            class="card bg-linear-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-blue-200 dark:border-blue-800 group">
                            <div class="card-body">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p
                                            class="text-sm font-medium text-neutral/70 mb-2">
                                            {{ __('Available Gigs') }}
                                        </p>
                                        <p
                                            class="text-4xl font-bold text-neutral mb-3">
                                            {{ $availableGigsCount ?? 0 }}
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
                                    <p class="text-xs text-neutral/60">
                                        Short-term opportunities</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Applied Gigs -->
                    <a href="{{ route('freelancer.gigs.applied') }}">
                        <div
                            class="card bg-linear-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-green-200 dark:border-green-800 group">
                            <div class="card-body">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p
                                            class="text-sm font-medium text-neutral/70 mb-2">
                                            {{ __('Applied Gigs') }}
                                        </p>
                                        <p
                                            class="text-4xl font-bold text-neutral mb-3">
                                            {{ $appliedGigsCount ?? 0 }}
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
                                    <p class="text-xs text-neutral/60">
                                        Awaiting
                                        response</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Current Gigs -->
                    <a href="{{ route('freelancer.gigs.in_progress') }}">
                        <div
                            class="card bg-linear-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-purple-200 dark:border-purple-800 group">
                            <div class="card-body">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p
                                            class="text-sm font-medium text-neutral/70 mb-2">
                                            {{ __('In-Progress Gigs') }}
                                        </p>
                                        <p
                                            class="text-4xl font-bold text-neutral mb-3">
                                            {{ $currentGigsCount ?? 0 }}
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
                                    <p class="text-xs text-neutral/60">
                                        Currently working on</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Completed Gigs -->
                    <a href="{{ route('freelancer.gigs.completed') }}">
                        <div
                            class="card bg-linear-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-orange-200 dark:border-orange-800 group">
                            <div class="card-body">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p
                                            class="text-sm font-medium text-neutral/70 mb-2">
                                            {{ __('Completed Gigs') }}
                                        </p>
                                        <p
                                            class="text-4xl font-bold text-neutral mb-3">
                                            {{ $completedGigsCount ?? 0 }}
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
                                    <p class="text-xs text-neutral/60">
                                        Successfully delivered</p>
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
            </div>

            <!-- Contracts Section -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                    <span class="text-3xl">📋</span>
                    Contracts Overview
                </h2>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Available Contracts -->
                    <a href="{{ route('freelancer.contracts.open') }}">
                        <div
                            class="card bg-linear-to-br from-cyan-50 to-cyan-100 dark:from-cyan-900/20 dark:to-cyan-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-cyan-200 dark:border-cyan-800 group">
                            <div class="card-body">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p
                                            class="text-sm font-medium text-neutral/70 mb-2">
                                            {{ __('Available Contracts') }}
                                        </p>
                                        <p
                                            class="text-4xl font-bold text-neutral mb-3">
                                            {{ $availableContractsCount ?? 0 }}
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
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                            Browse
                                        </div>
                                    </div>
                                    <div
                                        class="bg-cyan-500 dark:bg-cyan-600 p-4 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-8 w-8 text-white"
                                            fill="none"
                                            viewBox="0 0 24 24"
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
                                    <p class="text-xs text-neutral/60">
                                        Long-term opportunities</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Applied Contracts -->
                    <a href="{{ route('freelancer.contracts.applied') }}">
                        <div
                            class="card bg-linear-to-br from-teal-50 to-teal-100 dark:from-teal-900/20 dark:to-teal-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-teal-200 dark:border-teal-800 group">
                            <div class="card-body">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p
                                            class="text-sm font-medium text-neutral/70 mb-2">
                                            {{ __('Applied Contracts') }}
                                        </p>
                                        <p
                                            class="text-4xl font-bold text-neutral mb-3">
                                            {{ $appliedContractsCount ?? 0 }}
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
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Pending
                                        </div>
                                    </div>
                                    <div
                                        class="bg-teal-500 dark:bg-teal-600 p-4 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-8 w-8 text-white"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                        </svg>
                                    </div>
                                </div>
                                <div
                                    class="mt-4 pt-4 border-t border-teal-200 dark:border-teal-800">
                                    <p class="text-xs text-neutral/60">
                                        Awaiting response</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Current Contracts -->
                    <a href="{{ route('freelancer.contracts.in_progress') }}">
                        <div
                            class="card bg-linear-to-br from-indigo-50 to-indigo-100 dark:from-indigo-900/20 dark:to-indigo-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-indigo-200 dark:border-indigo-800 group">
                            <div class="card-body">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p
                                            class="text-sm font-medium text-neutral/70 mb-2">
                                            {{ __('In-Progress Contracts') }}
                                        </p>
                                        <p
                                            class="text-4xl font-bold text-neutral mb-3">
                                            {{ $currentContractsCount ?? 0 }}
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
                                            Active
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
                                                d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                        </svg>
                                    </div>
                                </div>
                                <div
                                    class="mt-4 pt-4 border-t border-indigo-200 dark:border-indigo-800">
                                    <p class="text-xs text-neutral/60">
                                        Currently working on</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Completed Contracts -->
                    <a href="{{ route('freelancer.contracts.completed') }}">
                        <div
                            class="card bg-linear-to-br from-amber-50 to-amber-100 dark:from-amber-900/20 dark:to-amber-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-amber-200 dark:border-amber-800 group">
                            <div class="card-body">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p
                                            class="text-sm font-medium text-neutral/70 mb-2">
                                            {{ __('Completed Contracts') }}
                                        </p>
                                        <p
                                            class="text-4xl font-bold text-neutral mb-3">
                                            {{ $completedContractsCount ?? 0 }}
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
                                                    d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                            </svg>
                                            Done
                                        </div>
                                    </div>
                                    <div
                                        class="bg-amber-500 dark:bg-amber-600 p-4 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-8 w-8 text-white"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                        </svg>
                                    </div>
                                </div>
                                <div
                                    class="mt-4 pt-4 border-t border-amber-200 dark:border-amber-800">
                                    <p class="text-xs text-neutral/60">
                                        Successfully delivered</p>
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
            </div>

            <!-- Combined Performance Overview -->
            <div class="mt-8 card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2
                        class="card-title text-2xl mb-4 flex items-center gap-2">
                        <span class="text-3xl">📊</span>
                        Overall Performance Overview
                    </h2>
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="stat bg-base-200 rounded-lg">
                            <div class="stat-title">Total Jobs</div>
                            <div class="stat-value text-primary">
                                @php
                                    $totalJobs =
                                        ($appliedGigsCount ?? 0) +
                                        ($currentGigsCount ?? 0) +
                                        ($completedGigsCount ?? 0) +
                                        ($appliedContractsCount ?? 0) +
                                        ($currentContractsCount ?? 0) +
                                        ($completedContractsCount ?? 0);
                                @endphp
                                {{ $totalJobs }}
                            </div>
                            <div class="stat-desc">Your career activity</div>
                        </div>
                        <div class="stat bg-base-200 rounded-lg">
                            <div class="stat-title">Active Work</div>
                            <div class="stat-value text-secondary">
                                @php
                                    $activeJobs =
                                        ($appliedGigsCount ?? 0) +
                                        ($currentGigsCount ?? 0) +
                                        ($appliedContractsCount ?? 0) +
                                        ($currentContractsCount ?? 0);
                                @endphp
                                {{ $activeJobs }}
                            </div>
                            <div class="stat-desc">Pending & ongoing</div>
                        </div>
                        <div class="stat bg-base-200 rounded-lg">
                            <div class="stat-title">Success Rate</div>
                            <div class="stat-value text-accent">
                                @php
                                    $completedTotal =
                                        ($completedGigsCount ?? 0) +
                                        ($completedContractsCount ?? 0);
                                    $rate =
                                        $totalJobs > 0
                                            ? round(
                                                ($completedTotal / $totalJobs) *
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
                                {{ ($availableGigsCount ?? 0) + ($availableContractsCount ?? 0) }}
                            </div>
                            <div class="stat-desc">Ready to apply</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gigs vs Contracts Comparison -->
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Gigs Summary -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3
                            class="card-title text-xl mb-4 flex items-center gap-2">
                            <span class="text-2xl">⚡</span>
                            Gigs Summary
                        </h3>
                        <div class="text-neutral space-y-3">
                            <div
                                class="flex justify-between items-center p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                <span class="font-medium">Available</span>
                                <span
                                    class="badge badge-lg badge-info">{{ $availableGigsCount ?? 0 }}</span>
                            </div>
                            <div
                                class="flex justify-between items-center p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                                <span class="font-medium">Applied</span>
                                <span
                                    class="badge badge-lg badge-success">{{ $appliedGigsCount ?? 0 }}</span>
                            </div>
                            <div
                                class="flex justify-between items-center p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                                <span class="font-medium">In Progress</span>
                                <span
                                    class="badge badge-lg badge-purple">{{ $currentGigsCount ?? 0 }}</span>
                            </div>
                            <div
                                class="flex justify-between items-center p-3 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
                                <span class="font-medium">Completed</span>
                                <span
                                    class="badge badge-lg badge-warning">{{ $completedGigsCount ?? 0 }}</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-base-300">
                            <div
                                class="flex justify-between items-center font-bold text-lg">
                                <span>Total Gigs Activity</span>
                                <span class="text-primary">
                                    {{ ($appliedGigsCount ?? 0) + ($currentGigsCount ?? 0) + ($completedGigsCount ?? 0) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contracts Summary -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3
                            class="card-title text-xl mb-4 flex items-center gap-2">
                            <span class="text-2xl">📋</span>
                            Contracts Summary
                        </h3>
                        <div class="text-neutral space-y-3">
                            <div
                                class="flex justify-between items-center p-3 bg-cyan-50 dark:bg-cyan-900/20 rounded-lg">
                                <span class="font-medium">Available</span>
                                <span
                                    class="badge badge-lg badge-info">{{ $availableContractsCount ?? 0 }}</span>
                            </div>
                            <div
                                class="flex justify-between items-center p-3 bg-teal-50 dark:bg-teal-900/20 rounded-lg">
                                <span class="font-medium">Applied</span>
                                <span
                                    class="badge badge-lg badge-success">{{ $appliedContractsCount ?? 0 }}</span>
                            </div>
                            <div
                                class="flex justify-between items-center p-3 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg">
                                <span class="font-medium">In Progress</span>
                                <span
                                    class="badge badge-lg badge-purple">{{ $currentContractsCount ?? 0 }}</span>
                            </div>
                            <div
                                class="flex justify-between items-center p-3 bg-amber-50 dark:bg-amber-900/20 rounded-lg">
                                <span class="font-medium">Completed</span>
                                <span
                                    class="badge badge-lg badge-warning">{{ $completedContractsCount ?? 0 }}</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-base-300">
                            <div
                                class="flex justify-between items-center font-bold text-lg">
                                <span>Total Contracts Activity</span>
                                <span class="text-secondary">
                                    {{ ($appliedContractsCount ?? 0) + ($currentContractsCount ?? 0) + ($completedContractsCount ?? 0) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Action Banners -->
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Gigs Action Banner -->
                <div
                    class="card bg-linear-to-r from-blue-500 to-purple-500 shadow-xl overflow-hidden">
                    <div class="card-body">
                        <div
                            class="flex flex-col items-center text-center gap-4">
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-2">
                                    ⚡ Quick Gigs Available
                                </h3>
                                <p class="text-white/90">
                                    {{ $availableGigsCount ?? 0 }} short-term
                                    opportunities waiting for you
                                </p>
                            </div>
                            <a href="{{ route('freelancer.gigs.index') }}"
                                class="btn btn-lg bg-white text-blue-600 hover:bg-base-200 border-0 shadow-lg gap-2">
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

                <!-- Contracts Action Banner -->
                <div
                    class="card bg-linear-to-r from-cyan-500 to-teal-500 shadow-xl overflow-hidden">
                    <div class="card-body">
                        <div
                            class="flex flex-col items-center text-center gap-4">
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-2">
                                    📋 Long-term Contracts
                                </h3>
                                <p class="text-white/90">
                                    {{ $availableContractsCount ?? 0 }}
                                    contract opportunities for stable work
                                </p>
                            </div>
                            <a href="{{ route('freelancer.gigs.index') }}"
                                class="btn btn-lg bg-white text-cyan-600 hover:bg-base-200 border-0 shadow-lg gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Browse Contracts
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
