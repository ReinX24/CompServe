<x-layouts.app>
    <div class="container mx-auto px-4 md:px-6 py-6">

        <!-- Page Header -->
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <h1 class="text-3xl font-bold text-primary">🎓 Certification Requests
            </h1>
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

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="table w-full rounded-lg shadow-sm">
                <thead class="bg-base-200">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Certification</th>
                        <th>Document</th>
                        <th>Status</th>
                        <th>Date Submitted</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($certifications as $cert)
                        <tr class="hover:bg-base-100">
                            <td>{{ $cert->id }}</td>
                            <td>{{ $cert->user->name ?? 'N/A' }}</td>
                            <td>{{ $cert->type }}</td>
                            <td>
                                @if ($cert->document_path)
                                    <a href="{{ Storage::url($cert->document_path) }}"
                                        target="_blank"
                                        class="text-primary underline">
                                        View
                                    </a>
                                @else
                                    N/A
                                @endif
                            </td>

                            <td>
                                @if ($cert->status === 'approved')
                                    <span
                                        class="badge badge-success">Approved</span>
                                @elseif ($cert->status === 'rejected')
                                    <span
                                        class="badge badge-error">Rejected</span>
                                @else
                                    <span
                                        class="badge badge-warning">Pending</span>
                                @endif
                            </td>

                            <td>{{ $cert->created_at->format('M d, Y') }}</td>

                            <td
                                class="text-right flex flex-col sm:flex-row sm:justify-end gap-2">

                                {{-- If the certification has been approved or rejected, disable the approve or reject but not the edit status button --}}

                                <!-- Approve Button -->
                                <button
                                    class="btn btn-sm btn-success {{ $cert->status !== 'pending' ? 'btn-disabled opacity-50' : '' }}"
                                    onclick="{{ $cert->status === 'pending' ? "openStatusModal($cert->id, 'approved')" : '' }}"
                                    {{ $cert->status !== 'pending' ? 'disabled' : '' }}>
                                    ✔️ Approve
                                </button>

                                <!-- Reject Button -->
                                <button
                                    class="btn btn-sm btn-error btn-outline {{ $cert->status !== 'pending' ? 'btn-disabled opacity-50' : '' }}"
                                    onclick="{{ $cert->status === 'pending' ? "openStatusModal($cert->id, 'rejected')" : '' }}"
                                    {{ $cert->status !== 'pending' ? 'disabled' : '' }}>
                                    ❌ Reject
                                </button>

                                <!-- Edit Status Button (always enabled) -->
                                <button class="btn btn-sm btn-warning"
                                    onclick="openStatusModal({{ $cert->id }}, 'edit')">
                                    ✏️ Edit Status
                                </button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $certifications->links() }}
        </div>
    </div>

    <!-- STATUS MODAL -->
    <dialog id="status-modal"
        class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-xl mb-4"
                id="modal-title">Update Status</h3>

            <form method="POST"
                id="status-form">
                @csrf

                <!-- Dynamic status selector when editing -->
                <div id="edit-status-container"
                    class="hidden">
                    <label class="label font-semibold">Select Status:</label>
                    <select name="status"
                        id="status-select"
                        class="select select-bordered w-full">
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>

                <div class="modal-action">
                    <button type="submit"
                        class="btn btn-primary">Confirm</button>
                    <button type="button"
                        class="btn"
                        onclick="document.getElementById('status-modal').close()">Cancel</button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        function openStatusModal(certId, action) {
            const modal = document.getElementById('status-modal');
            const form = document.getElementById('status-form');
            const modalTitle = document.getElementById('modal-title');
            const editContainer = document.getElementById('edit-status-container');

            let route = "";

            // APPROVE
            if (action === 'approved') {
                modalTitle.innerText = `Approve Certification #${certId}?`;
                route = `/admin/certifications/${certId}/approve`;
                editContainer.classList.add('hidden');
            }

            // REJECT
            else if (action === 'rejected') {
                modalTitle.innerText = `Reject Certification #${certId}?`;
                route = `/admin/certifications/${certId}/reject`;
                editContainer.classList.add('hidden');
            }

            // EDIT STATUS
            else if (action === 'edit') {
                modalTitle.innerText = `Edit Status for Certification #${certId}`;
                route = `/admin/certifications/${certId}/status`;
                editContainer.classList.remove('hidden');
            }

            form.action = route;

            modal.showModal();
        }
    </script>

</x-layouts.app>
