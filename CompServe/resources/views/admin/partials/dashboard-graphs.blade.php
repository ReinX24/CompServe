{{-- Job Listings Graph --}}
<div class="bg-base-200 text-base-content shadow-sm rounded-lg p-6 mb-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">
            Job Listings Overview
        </h2>

        <form method="GET"
            action="{{ route('admin.dashboard') }}">
            <input type="hidden"
                name="filter_users"
                value="{{ $filterUsers }}">
            <select name="filter_jobs"
                onchange="this.form.submit()"
                class="select">
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

<div class="bg-base-200 text-base-content shadow-sm rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">
            Registered Users Overview
        </h2>

        <form method="GET"
            action="{{ route('admin.dashboard') }}">
            <input type="hidden"
                name="filter_jobs"
                value="{{ $filterJobs }}">
            <select name="filter_users"
                onchange="this.form.submit()"
                class="select">
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
