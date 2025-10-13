<x-layouts.app>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Manage Job Listings</h1>

        @session('success')
            <div class="mb-4">
                {{-- Success message --}}
                <div role="alert"
                    class="alert alert-success alert-soft text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 shrink-0 stroke-current"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endsession

        <div class="overflow-x-auto bg-base-100 shadow-md rounded-lg">
            <table class="table w-full">
                <thead class="bg-base-200">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Client</th>
                        <th>Status</th>
                        <th>Budget</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                        <tr class="hover">
                            <td>{{ $job->id }}</td>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->client->name ?? 'N/A' }}</td>
                            <td>
                                <span class="badge badge-outline badge-primary">
                                    {{ ucfirst($job->status) }}
                                </span>
                            </td>
                            <td>${{ number_format($job->budget, 2) }}</td>
                            <td class="text-right space-x-2">
                                <!-- Edit Button -->
                                <button
                                    onclick="document.getElementById('editModal-{{ $job->id }}').showModal()"
                                    class="btn btn-sm btn-info">Edit</button>

                                <!-- Delete Form -->
                                <form method="POST"
                                    action="{{ route('admin.jobs.delete', $job) }}"
                                    class="inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-error"
                                        onclick="return confirm('Delete this job?')">Delete</button>
                                </form>

                                <!-- Edit Modal -->
                                <dialog id="editModal-{{ $job->id }}"
                                    class="modal">
                                    <div class="modal-box">
                                        <h3 class="font-bold text-lg mb-4">Edit
                                            Job</h3>
                                        <form method="POST"
                                            action="{{ route('admin.jobs.update', $job) }}">
                                            @csrf @method('PUT')

                                            <div class="mb-3">
                                                <label
                                                    class="block font-semibold mb-1">Title</label>
                                                <input type="text"
                                                    name="title"
                                                    value="{{ $job->title }}"
                                                    class="input input-bordered w-full"
                                                    required>
                                            </div>

                                            <div class="mb-3">
                                                <label
                                                    class="block font-semibold mb-1">Description</label>
                                                <textarea name="description"
                                                    class="textarea textarea-bordered w-full"
                                                    required>{{ $job->description }}</textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label
                                                    class="block font-semibold mb-1">Budget</label>
                                                <input type="number"
                                                    name="budget"
                                                    value="{{ $job->budget }}"
                                                    class="input input-bordered w-full">
                                            </div>

                                            <div class="mb-3">
                                                <label
                                                    class="block font-semibold mb-1">Status</label>
                                                <select name="status"
                                                    class="select select-bordered w-full">
                                                    <option value="open"
                                                        {{ $job->status === 'open' ? 'selected' : '' }}>
                                                        Open</option>
                                                    <option value="in_progress"
                                                        {{ $job->status === 'in_progress' ? 'selected' : '' }}>
                                                        In Progress</option>
                                                    <option value="cancelled"
                                                        {{ $job->status === 'cancelled' ? 'selected' : '' }}>
                                                        Cancelled</option>
                                                    <option value="completed"
                                                        {{ $job->status === 'completed' ? 'selected' : '' }}>
                                                        Completed</option>
                                                </select>
                                            </div>

                                            <div class="modal-action">
                                                <button
                                                    class="btn btn-primary">Save</button>
                                                <button type="button"
                                                    onclick="document.getElementById('editModal-{{ $job->id }}').close()"
                                                    class="btn">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </dialog>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
