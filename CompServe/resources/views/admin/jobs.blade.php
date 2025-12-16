<x-layouts.app>
    <div
        class="min-h-screen bg-linear-to-br from-base-200 via-base-100 to-base-200 py-8 px-4">
        <div class="max-w-7xl mx-auto">

            <!-- Page Header -->
            <div class="mb-8">
                <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="bg-primary/10 p-3 rounded-xl">
                            💼
                        </div>
                        <div>
                            <h1
                                class="text-4xl font-bold bg-linear-to-r from-primary to-secondary bg-clip-text text-transparent">
                                Jobs
                            </h1>
                            <p class="text-base-content/70 text-sm mt-1">
                                View and manage all job listings
                            </p>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div
                        class="stats shadow-lg bg-base-100 border-2 border-base-300">
                        <div class="stat py-3 px-4">
                            <div class="stat-title text-xs">Total Jobs</div>
                            <div class="stat-value text-2xl text-primary">
                                {{ $jobs->total() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div
                    class="alert alert-success mb-6 shadow-lg border-2 border-success/20">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Jobs Table Card -->
            <div class="card bg-base-100 shadow-xl border-2 border-base-300">
                <div class="card-body p-0">

                    <!-- Desktop Table -->
                    <div class="hidden lg:block overflow-x-auto">
                        <table class="table table-zebra">
                            <thead class="bg-base-200">
                                <tr>
                                    <th>ID</th>
                                    <th>Job Details</th>
                                    <th>Client</th>
                                    <th>Status</th>
                                    <th class="text-right">Budget</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($jobs as $job)
                                    <tr
                                        class="hover:bg-base-200/50 transition-colors">
                                        <td class="font-mono text-sm">
                                            <span
                                                class="badge badge-ghost badge-sm">
                                                {{ $job->id }}
                                            </span>
                                        </td>

                                        <td>
                                            <div class="font-bold">
                                                {{ $job->title }}</div>
                                            <div
                                                class="text-sm text-base-content/60 line-clamp-1">
                                                {{ $job->description }}
                                            </div>
                                        </td>

                                        <td>
                                            <div
                                                class="flex items-center gap-3">
                                                <div
                                                    class="avatar avatar-placeholder">
                                                    <div
                                                        class="bg-primary text-primary-content rounded-full w-10">
                                                        <span
                                                            class="text-sm font-bold">
                                                            {{ substr($job->client->name ?? 'N', 0, 1) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="font-semibold">
                                                    {{ $job->client->name ?? 'N/A' }}
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            @php
                                                $statusMap = [
                                                    'open' => 'badge-success',
                                                    'in_progress' =>
                                                        'badge-warning',
                                                    'completed' => 'badge-info',
                                                    'cancelled' =>
                                                        'badge-error',
                                                ];
                                            @endphp

                                            <span
                                                class="badge {{ $statusMap[$job->status] ?? 'badge-ghost' }}">
                                                {{ ucfirst(str_replace('_', ' ', $job->status)) }}
                                            </span>
                                        </td>

                                        <td
                                            class="text-right font-bold text-success">
                                            ${{ number_format($job->budget, 2) }}
                                        </td>

                                        <td class="text-right">
                                            <div class="flex justify-end gap-2">
                                                <button
                                                    onclick="document.getElementById('editModal-{{ $job->id }}').showModal()"
                                                    class="btn btn-sm btn-primary">
                                                    Edit
                                                </button>

                                                <form method="POST"
                                                    action="{{ route('admin.jobs.delete', $job) }}">
                                                    @csrf @method('DELETE')
                                                    <button
                                                        class="btn btn-sm btn-error"
                                                        onclick="return confirm('Delete this job?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="text-center py-12 text-base-content/60">
                                            No jobs found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="lg:hidden p-4 space-y-4">
                        @foreach ($jobs as $job)
                            <div
                                class="card bg-base-200 border-2 border-base-300 shadow-lg">
                                <div class="card-body p-4">
                                    <h3 class="font-bold">{{ $job->title }}
                                    </h3>
                                    <p
                                        class="text-sm text-base-content/60 line-clamp-2">
                                        {{ $job->description }}
                                    </p>

                                    <div
                                        class="flex items-center justify-between mt-3">
                                        <span class="badge badge-outline">
                                            {{ ucfirst($job->status) }}
                                        </span>
                                        <span class="font-bold text-success">
                                            ${{ number_format($job->budget, 2) }}
                                        </span>
                                    </div>

                                    <div class="mt-3 flex gap-2">
                                        <button
                                            onclick="document.getElementById('editModal-{{ $job->id }}').showModal()"
                                            class="btn btn-sm btn-primary flex-1">
                                            Edit
                                        </button>

                                        <form method="POST"
                                            action="{{ route('admin.jobs.delete', $job) }}"
                                            class="flex-1">
                                            @csrf @method('DELETE')
                                            <button
                                                class="btn btn-sm btn-error w-full">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

            <!-- Pagination -->
            @if ($jobs->hasPages())
                <div class="mt-6 flex justify-center">
                    {{ $jobs->links() }}
                </div>
            @endif

        </div>
    </div>
</x-layouts.app>
