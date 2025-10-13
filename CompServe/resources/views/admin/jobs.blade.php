<x-layouts.app>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Manage Job Listings</h1>

        <div class="overflow-x-auto bg-base-100 shadow-md rounded-lg">
            <table class="table w-full">
                <thead class="bg-base-200">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Client</th>
                        <th>Budget</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                        <tr class="hover">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->client->name ?? 'N/A' }}</td>
                            <td>${{ $job->budget }}</td>
                            <td>
                                <span
                                    class="badge {{ $job->status == 'open' ? 'badge-success' : 'badge-neutral' }}">
                                    {{ ucfirst($job->status) }}
                                </span>
                            </td>
                            <td class="text-right space-x-2">
                                <form method="POST"
                                    action="{{ route('admin.jobs.update', $job) }}"
                                    class="inline">
                                    @csrf @method('PUT')
                                    <button
                                        class="btn btn-sm btn-info">Edit</button>
                                </form>

                                <form method="POST"
                                    action="{{ route('admin.jobs.delete', $job) }}"
                                    class="inline">
                                    @csrf @method('DELETE')
                                    <button
                                        class="btn btn-sm btn-error">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
