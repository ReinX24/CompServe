<x-layouts.app>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            {{ __('Client Dashboard') }}</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">
            {{ __('Welcome to the dashboard') }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p
                        class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Total Users') }}</p>
                    <p
                        class="text-2xl font-bold text-gray-800 dark:text-gray-100 mt-1">
                        {{ $usersCount ?? '--' }}</p>
                    <p class="text-xs text-gray-500 flex items-center mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 mr-1"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        {{ __('No data') }}
                    </p>
                </div>
                <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-blue-500 dark:text-blue-300"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Revenue Card -->
        <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p
                        class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Total Jobs') }}</p>
                    <p
                        class="text-2xl font-bold text-gray-800 dark:text-gray-100 mt-1">
                        {{ $jobsCount ?? '--' }}</p>
                    <p class="text-xs text-gray-500 flex items-center mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 mr-1"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        {{ __('No data') }}
                    </p>
                </div>
                <div class="bg-green-100 dark:bg-green-900 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-green-500 dark:text-green-300"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p
                        class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Total Reviews') }}</p>
                    <p
                        class="text-2xl font-bold text-gray-800 dark:text-gray-100 mt-1">
                        {{ $reviewsCount ?? '--' }}</p>
                    <p class="text-xs text-gray-500 flex items-center mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 mr-1"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        {{ __('No data') }}
                    </p>
                </div>
                <div class="bg-purple-100 dark:bg-purple-900 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-purple-500 dark:text-purple-300"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Visitors Card -->
        <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p
                        class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Total Visitors') }}</p>
                    <p
                        class="text-2xl font-bold text-gray-800 dark:text-gray-100 mt-1">
                        --</p>
                    <p class="text-xs text-gray-500 flex items-center mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 mr-1"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        {{ __('No data') }}
                    </p>
                </div>
                <div class="bg-orange-100 dark:bg-orange-900 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-orange-500 dark:text-orange-300"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Job Listings --}}
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                Job Listings Overview
            </h2>

            <form method="GET"
                action="{{ route('admin.dashboard') }}">
                <input type="hidden"
                    name="filter_users"
                    value="{{ $filterUsers }}">
                <select name="filter_jobs"
                    onchange="this.form.submit()"
                    class="border rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                    <option value="daily"
                        {{ $filterJobs == 'daily' ? 'selected' : '' }}>Daily
                    </option>
                    <option value="weekly"
                        {{ $filterJobs == 'weekly' ? 'selected' : '' }}>Weekly
                    </option>
                    <option value="monthly"
                        {{ $filterJobs == 'monthly' ? 'selected' : '' }}>
                        Monthly</option>
                    <option value="yearly"
                        {{ $filterJobs == 'yearly' ? 'selected' : '' }}>Yearly
                    </option>
                </select>
            </form>
        </div>

        <canvas id="jobsChart"
            height="120"></canvas>
    </div>

    {{-- Registered Users --}}
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                Registered Users Overview
            </h2>

            <form method="GET"
                action="{{ route('admin.dashboard') }}">
                <input type="hidden"
                    name="filter_jobs"
                    value="{{ $filterJobs }}">
                <select name="filter_users"
                    onchange="this.form.submit()"
                    class="border rounded-md px-3 py-2 dark:bg-gray-700 dark:text-white">
                    <option value="daily"
                        {{ $filterUsers == 'daily' ? 'selected' : '' }}>Daily
                    </option>
                    <option value="weekly"
                        {{ $filterUsers == 'weekly' ? 'selected' : '' }}>Weekly
                    </option>
                    <option value="monthly"
                        {{ $filterUsers == 'monthly' ? 'selected' : '' }}>
                        Monthly</option>
                    <option value="yearly"
                        {{ $filterUsers == 'yearly' ? 'selected' : '' }}>Yearly
                    </option>
                </select>
            </form>
        </div>

        <canvas id="usersChart"
            height="120"></canvas>
    </div>

    {{-- TODO: install chartjs using npm --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const jobCtx = document.getElementById('jobsChart').getContext('2d');
        const jobData = @json($jobChartData);
        new Chart(jobCtx, {
            type: 'bar',
            data: {
                labels: jobData.map(item => item.label),
                datasets: [{
                    label: 'Job Listings',
                    data: jobData.map(item => item.count),
                    backgroundColor: 'rgba(37, 99, 235, 0.5)',
                    borderColor: 'rgba(37, 99, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Job Listings Over Time',
                        color: '#111'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const userCtx = document.getElementById('usersChart').getContext('2d');
        const userData = @json($userChartData);
        new Chart(userCtx, {
            type: 'line',
            data: {
                labels: userData.map(item => item.label),
                datasets: [{
                    label: 'Registered Users',
                    data: userData.map(item => item.count),
                    backgroundColor: 'rgba(16, 185, 129, 0.3)',
                    borderColor: 'rgba(5, 150, 105, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Registered Users Over Time',
                        color: '#111'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-layouts.app>
