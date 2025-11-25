<x-layouts.app>
    <div class="container mx-auto px-4 md:px-6 py-6">
        <!-- Page Header -->
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <h1 class="text-3xl font-bold text-primary">💼 Manage Job Listings
            </h1>
            {{-- <a href="{{ route('admin.jobs.create') }}"
                class="btn btn-primary w-full md:w-auto">
                ➕ Add Job
            </a> --}}
        </div>

        <!-- Alerts -->
        @session('success')
            <div class="mb-4">
                <div role="alert"
                    class="alert alert-success alert-soft text-lg shadow-md flex items-center gap-2">
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

        <!-- Jobs Table -->
        <div class="overflow-x-auto">
            <table class="table w-full rounded-lg shadow-sm">
                <thead class="bg-base-200">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th class="hidden sm:table-cell">Client</th>
                        <th>Status</th>
                        <th class="hidden md:table-cell">Budget</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                        <tr class="hover:bg-base-100 transition-colors">
                            <td class="whitespace-normal">{{ $job->id }}
                            </td>
                            <td class="whitespace-normal font-semibold">
                                {{ $job->title }}</td>
                            <td class="whitespace-normal hidden sm:table-cell">
                                {{ $job->client->name ?? 'N/A' }}</td>
                            <td>
                                <span class="badge badge-outline badge-primary">
                                    {{ ucfirst($job->status) }}
                                </span>
                            </td>
                            <td class="whitespace-normal hidden md:table-cell">
                                ${{ number_format($job->budget, 2) }}</td>
                            <td
                                class="text-right flex flex-col sm:flex-row sm:justify-end gap-2 mt-2 sm:mt-0">
                                <!-- Edit -->
                                <button
                                    onclick="document.getElementById('editModal-{{ $job->id }}').showModal()"
                                    class="btn btn-sm btn-info">✏️ Edit</button>

                                <!-- Delete -->
                                <form method="POST"
                                    action="{{ route('admin.jobs.delete', $job) }}">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-error"
                                        onclick="return confirm('Delete this job?')">❌
                                        Delete</button>
                                </form>

                                <!-- Edit Modal -->
                                <dialog id="editModal-{{ $job->id }}"
                                    class="modal">
                                    <div class="modal-box max-w-md">
                                        <h3 class="font-bold text-lg mb-4">Edit
                                            Job</h3>
                                        <form method="POST"
                                            action="{{ route('admin.jobs.update', $job) }}"
                                            class="space-y-3">
                                            @csrf @method('PUT')

                                            <div>
                                                <label class="label"><span
                                                        class="label-text">Title</span></label>
                                                <input type="text"
                                                    name="title"
                                                    value="{{ $job->title }}"
                                                    class="input input-bordered w-full"
                                                    required>
                                            </div>

                                            <div>
                                                <label class="label"><span
                                                        class="label-text">Description</span></label>
                                                <textarea name="description"
                                                    class="textarea textarea-bordered w-full"
                                                    required>{{ $job->description }}</textarea>
                                            </div>

                                            <div>
                                                <label class="label"><span
                                                        class="label-text">Budget</span></label>
                                                <input type="number"
                                                    name="budget"
                                                    value="{{ $job->budget }}"
                                                    class="input input-bordered w-full">
                                            </div>

                                            <div>
                                                <label class="label"><span
                                                        class="label-text">Status</span></label>
                                                <select name="status"
                                                    class="select select-bordered w-full">
                                                    <option value="open"
                                                        @selected($job->status === 'open')>
                                                        Open</option>
                                                    <option value="in_progress"
                                                        @selected($job->status === 'in_progress')>
                                                        In Progress</option>
                                                    <option value="cancelled"
                                                        @selected($job->status === 'cancelled')>
                                                        Cancelled</option>
                                                    <option value="completed"
                                                        @selected($job->status === 'completed')>
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
