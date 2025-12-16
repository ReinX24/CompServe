<x-layouts.app>
    <div
        class="min-h-screen bg-linear-to-br from-base-200 via-base-100 to-base-200 py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <span class="text-5xl">⚙️</span>
                    <h1
                        class="text-4xl font-bold bg-linear-to-r from-secondary to-accent bg-clip-text text-transparent">
                        {{ __('Admin Dashboard') }}
                    </h1>
                </div>
                <p class="text-base-content/70 text-lg ml-16">Welcome to the
                    dashboard. Monitor and manage platform activities.</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Users Card -->
                <div
                    class="card bg-linear-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-blue-200 dark:border-blue-800 group">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p
                                    class="text-sm font-medium text-base-content/70 mb-2">
                                    {{ __('Total Users') }}
                                </p>
                                <p
                                    class="text-4xl font-bold text-base-content mb-3">
                                    {{ $usersCount ?? '--' }}
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
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Registered
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
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                        </div>
                        <div
                            class="mt-4 pt-4 border-t border-blue-200 dark:border-blue-800">
                            <p class="text-xs text-base-content/60">Platform
                                members</p>
                        </div>
                    </div>
                </div>

                <!-- Total Jobs Card -->
                <div
                    class="card bg-linear-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-green-200 dark:border-green-800 group">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p
                                    class="text-sm font-medium text-base-content/70 mb-2">
                                    {{ __('Total Jobs') }}
                                </p>
                                <p
                                    class="text-4xl font-bold text-base-content mb-3">
                                    {{ $jobsCount ?? '--' }}
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
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Active
                                </div>
                            </div>
                            <div
                                class="bg-green-500 dark:bg-green-600 p-4 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8 text-white"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                </svg>
                            </div>
                        </div>
                        <div
                            class="mt-4 pt-4 border-t border-green-200 dark:border-green-800">
                            <p class="text-xs text-base-content/60">Posted
                                opportunities</p>
                        </div>
                    </div>
                </div>

                <!-- Total Reviews Card -->
                <div
                    class="card bg-linear-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-purple-200 dark:border-purple-800 group">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p
                                    class="text-sm font-medium text-base-content/70 mb-2">
                                    {{ __('Total Reviews') }}
                                </p>
                                <p
                                    class="text-4xl font-bold text-base-content mb-3">
                                    {{ $reviewsCount ?? '--' }}
                                </p>
                                <div class="badge badge-purple badge-sm gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-3 w-3"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    Submitted
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
                                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                </svg>
                            </div>
                        </div>
                        <div
                            class="mt-4 pt-4 border-t border-purple-200 dark:border-purple-800">
                            <p class="text-xs text-base-content/60">User
                                feedback received</p>
                        </div>
                    </div>
                </div>

                <!-- Pending Certifications Card -->
                <div
                    class="card bg-linear-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 shadow-xl hover:shadow-2xl transition-all duration-300 border-2 border-orange-200 dark:border-orange-800 group">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p
                                    class="text-sm font-medium text-base-content/70 mb-2">
                                    {{ __('Pending Certifications') }}
                                </p>
                                <p
                                    class="text-4xl font-bold text-base-content mb-3">
                                    {{ $pendingCertificationsCount ?? '--' }}
                                </p>
                                <div class="badge badge-warning badge-sm gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-3 w-3 animate-pulse"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Awaiting
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
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                            </div>
                        </div>
                        <div
                            class="mt-4 pt-4 border-t border-orange-200 dark:border-orange-800">
                            <p class="text-xs text-base-content/60">Requires
                                review</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Graphs Section -->
            <div class="mt-8">
                @include('admin.partials.dashboard-graphs')
            </div>
        </div>
    </div>
</x-layouts.app>
