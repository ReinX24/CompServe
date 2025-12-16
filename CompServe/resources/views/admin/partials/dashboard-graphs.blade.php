{{-- Job Listings Graph --}}
<div
    class="card bg-base-100 shadow-xl mb-6 border-2 border-base-300 hover:border-primary/30 transition-all duration-300">
    <div class="card-body">
        <div
            class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div class="flex items-center gap-3">
                <div class="bg-blue-500/10 p-3 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-blue-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-base-content">
                        Job Listings Overview
                    </h2>
                    <p class="text-sm text-base-content/60 mt-1">Track job
                        posting trends</p>
                </div>
            </div>

            <form method="GET"
                action="{{ route('admin.dashboard') }}"
                class="w-full sm:w-auto">
                <input type="hidden"
                    name="filter_users"
                    value="{{ $filterUsers }}">
                <div class="flex items-center gap-2">
                    <label
                        class="text-sm font-medium text-base-content/70 hidden sm:block">Time
                        Range:</label>
                    <select name="filter_jobs"
                        onchange="this.form.submit()"
                        class="select select-bordered select-sm sm:select-md bg-base-200 border-2 hover:border-primary focus:border-primary transition-colors w-full sm:w-auto">
                        <option value="daily"
                            {{ $filterJobs == 'daily' ? 'selected' : '' }}>📅
                            Daily</option>
                        <option value="weekly"
                            {{ $filterJobs == 'weekly' ? 'selected' : '' }}>📊
                            Weekly</option>
                        <option value="monthly"
                            {{ $filterJobs == 'monthly' ? 'selected' : '' }}>📈
                            Monthly</option>
                        <option value="yearly"
                            {{ $filterJobs == 'yearly' ? 'selected' : '' }}>📆
                            Yearly</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="bg-base-200/50 rounded-xl p-4">
            <canvas id="jobsChart"
                height="120"></canvas>
        </div>

        <div
            class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-6 pt-6 border-t border-base-300">
            <div
                class="text-center p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                <p class="text-xs text-base-content/60 font-medium mb-1">Peak
                    Period</p>
                <p class="text-sm font-bold text-blue-600 dark:text-blue-400"
                    id="jobPeakPeriod">--</p>
            </div>
            <div
                class="text-center p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                <p class="text-xs text-base-content/60 font-medium mb-1">Total
                    Jobs</p>
                <p class="text-sm font-bold text-green-600 dark:text-green-400"
                    id="jobTotalCount">--</p>
            </div>
            <div
                class="text-center p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                <p class="text-xs text-base-content/60 font-medium mb-1">Average
                </p>
                <p class="text-sm font-bold text-purple-600 dark:text-purple-400"
                    id="jobAverage">--</p>
            </div>
            <div
                class="text-center p-3 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
                <p class="text-xs text-base-content/60 font-medium mb-1">Trend
                </p>
                <p class="text-sm font-bold text-orange-600 dark:text-orange-400"
                    id="jobTrend">--</p>
            </div>
        </div>
    </div>
</div>

{{-- Registered Users Graph --}}
<div
    class="card bg-base-100 shadow-xl border-2 border-base-300 hover:border-success/30 transition-all duration-300">
    <div class="card-body">
        <div
            class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div class="flex items-center gap-3">
                <div class="bg-green-500/10 p-3 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-green-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-base-content">
                        Registered Users Overview
                    </h2>
                    <p class="text-sm text-base-content/60 mt-1">Monitor user
                        growth patterns</p>
                </div>
            </div>

            <form method="GET"
                action="{{ route('admin.dashboard') }}"
                class="w-full sm:w-auto">
                <input type="hidden"
                    name="filter_jobs"
                    value="{{ $filterJobs }}">
                <div class="flex items-center gap-2">
                    <label
                        class="text-sm font-medium text-base-content/70 hidden sm:block">Time
                        Range:</label>
                    <select name="filter_users"
                        onchange="this.form.submit()"
                        class="select select-bordered select-sm sm:select-md bg-base-200 border-2 hover:border-success focus:border-success transition-colors w-full sm:w-auto">
                        <option value="daily"
                            {{ $filterUsers == 'daily' ? 'selected' : '' }}>📅
                            Daily</option>
                        <option value="weekly"
                            {{ $filterUsers == 'weekly' ? 'selected' : '' }}>📊
                            Weekly</option>
                        <option value="monthly"
                            {{ $filterUsers == 'monthly' ? 'selected' : '' }}>
                            📈 Monthly</option>
                        <option value="yearly"
                            {{ $filterUsers == 'yearly' ? 'selected' : '' }}>📆
                            Yearly</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="bg-base-200/50 rounded-xl p-4">
            <canvas id="usersChart"
                height="120"></canvas>
        </div>

        <div
            class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-6 pt-6 border-t border-base-300">
            <div
                class="text-center p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                <p class="text-xs text-base-content/60 font-medium mb-1">Peak
                    Period</p>
                <p class="text-sm font-bold text-blue-600 dark:text-blue-400"
                    id="userPeakPeriod">--</p>
            </div>
            <div
                class="text-center p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                <p class="text-xs text-base-content/60 font-medium mb-1">Total
                    Users</p>
                <p class="text-sm font-bold text-green-600 dark:text-green-400"
                    id="userTotalCount">--</p>
            </div>
            <div
                class="text-center p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                <p class="text-xs text-base-content/60 font-medium mb-1">Average
                </p>
                <p class="text-sm font-bold text-purple-600 dark:text-purple-400"
                    id="userAverage">--</p>
            </div>
            <div
                class="text-center p-3 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
                <p class="text-xs text-base-content/60 font-medium mb-1">Growth
                    Rate</p>
                <p class="text-sm font-bold text-orange-600 dark:text-orange-400"
                    id="userGrowth">--</p>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js Script --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function formatWeeklyLabel(label) {
        // Expecting format: YYYYWW (e.g. 202550)
        labelStr = label.toString();
        labelStr = labelStr.slice(0, 4) + ' • Week ' + labelStr.slice(4);
        return labelStr;
    }

    // Job Listings Chart
    const jobCtx = document.getElementById('jobsChart').getContext('2d');
    const jobData = @json($jobChartData);

    // Calculate job statistics
    const jobCounts = jobData.map(item => item.count);
    const jobTotal = jobCounts.reduce((a, b) => a + b, 0);
    const jobAvg = jobTotal > 0 ? (jobTotal / jobCounts.length).toFixed(1) : 0;
    const jobMax = Math.max(...jobCounts);
    const jobPeak = jobData.find(item => item.count === jobMax);
    const jobTrendValue = jobCounts.length > 1 ?
        ((jobCounts[jobCounts.length - 1] - jobCounts[0]) / Math.max(jobCounts[
            0], 1) * 100).toFixed(1) : 0;

    document.getElementById('jobPeakPeriod').textContent = jobPeak ?
        ('{{ $filterJobs }}' === 'weekly' ?
            formatWeeklyLabel(jobPeak.label) :
            jobPeak.label) :
        '--';

    document.getElementById('jobTotalCount').textContent = jobTotal;
    document.getElementById('jobAverage').textContent = jobAvg;
    document.getElementById('jobTrend').textContent = jobTrendValue > 0 ?
        `↗ ${jobTrendValue}%` : jobTrendValue < 0 ? `↘ ${jobTrendValue}%` :
        '→ 0%';

    new Chart(jobCtx, {
        type: 'bar',
        data: {
            labels: jobData.map(item =>
                '{{ $filterJobs }}' === 'weekly' ?
                formatWeeklyLabel(item.label) :
                item.label
            ),
            datasets: [{
                label: 'Job Listings',
                data: jobData.map(item => item.count),
                backgroundColor: 'rgba(59, 130, 246, 0.5)',
                borderColor: 'rgba(37, 99, 235, 1)',
                borderWidth: 2,
                borderRadius: 8,
                hoverBackgroundColor: 'rgba(59, 130, 246, 0.7)',
                hoverBorderColor: 'rgba(37, 99, 235, 1)',
                hoverBorderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Jobs Posted: ' + context.parsed
                                .y;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        precision: 0,
                        font: {
                            size: 11
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 11
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });

    // Registered Users Chart
    const userCtx = document.getElementById('usersChart').getContext('2d');
    const userData = @json($userChartData);

    // Calculate user statistics
    const userCounts = userData.map(item => item.count);
    const userTotal = userCounts.reduce((a, b) => a + b, 0);
    const userAvg = userTotal > 0 ? (userTotal / userCounts.length).toFixed(1) :
        0;
    const userMax = Math.max(...userCounts);
    const userPeak = userData.find(item => item.count === userMax);
    const userGrowthValue = userCounts.length > 1 ?
        ((userCounts[userCounts.length - 1] - userCounts[0]) / Math.max(
            userCounts[0], 1) * 100).toFixed(1) : 0;

    document.getElementById('userPeakPeriod').textContent = userPeak ?
        ('{{ $filterUsers }}' === 'weekly' ?
            formatWeeklyLabel(userPeak.label) :
            userPeak.label) :
        '--';

    document.getElementById('userTotalCount').textContent = userTotal;
    document.getElementById('userAverage').textContent = userAvg;
    document.getElementById('userGrowth').textContent = userGrowthValue > 0 ?
        `↗ ${userGrowthValue}%` : userGrowthValue < 0 ?
        `↘ ${userGrowthValue}%` : '→ 0%';

    new Chart(userCtx, {
        type: 'line',
        data: {
            labels: userData.map(item =>
                '{{ $filterUsers }}' === 'weekly' ?
                formatWeeklyLabel(item.label) :
                item.label
            ),
            datasets: [{
                label: 'Registered Users',
                data: userData.map(item => item.count),
                backgroundColor: 'rgba(16, 185, 129, 0.2)',
                borderColor: 'rgba(5, 150, 105, 1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: 'rgba(5, 150, 105, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointHoverBackgroundColor: 'rgba(5, 150, 105, 1)',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    borderColor: 'rgba(5, 150, 105, 1)',
                    borderWidth: 2,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'New Users: ' + context.parsed.y;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        precision: 0,
                        font: {
                            size: 11
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 11
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
</script>
