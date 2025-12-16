<x-layouts.app>
    <div
        class="min-h-screen bg-linear-to-br from-base-200 via-base-100 to-base-200 py-8 px-4">
        <div class="max-w-7xl mx-auto">

            <!-- Page Header -->
            <div class="mb-8">
                <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="bg-primary/10 p-3 rounded-xl text-2xl">
                            🎓
                        </div>
                        <div>
                            <h1
                                class="text-4xl font-bold bg-linear-to-r from-primary to-secondary bg-clip-text text-transparent">
                                Certification Requests
                            </h1>
                            <p class="text-sm text-base-content/60 mt-1">
                                Review and manage freelancer certification
                                submissions
                            </p>
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

            <!-- Table Card -->
            <div class="card bg-base-100 shadow-xl border-2 border-base-300">
                <div class="card-body p-0">

                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full">
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
                                @forelse ($certifications as $cert)
                                    <tr
                                        class="hover:bg-base-200/50 transition-colors">
                                        <td class="font-mono text-sm">
                                            <span
                                                class="badge badge-ghost badge-sm">
                                                {{ $cert->id }}
                                            </span>
                                        </td>

                                        <td class="font-semibold">
                                            {{ $cert->user->name ?? 'N/A' }}
                                        </td>

                                        <td>
                                            <span class="badge badge-outline">
                                                {{ $cert->type }}
                                            </span>
                                        </td>

                                        <td>
                                            @if ($cert->document_path)
                                                <a href="{{ Storage::url($cert->document_path) }}"
                                                    target="_blank"
                                                    class="link link-primary font-medium">
                                                    View Document
                                                </a>
                                            @else
                                                <span
                                                    class="text-base-content/40">N/A</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($cert->status === 'approved')
                                                <span
                                                    class="badge badge-success gap-1">✔
                                                    Approved</span>
                                            @elseif($cert->status === 'rejected')
                                                <span
                                                    class="badge badge-error gap-1">✖
                                                    Rejected</span>
                                            @else
                                                <span
                                                    class="badge badge-warning gap-1">⏳
                                                    Pending</span>
                                            @endif
                                        </td>

                                        <td class="text-sm">
                                            {{ $cert->created_at->format('M d, Y') }}
                                        </td>

                                        <td class="text-right">
                                            <div
                                                class="flex flex-col sm:flex-row justify-end gap-2">

                                                <!-- Approve -->
                                                <button
                                                    class="btn btn-xs btn-success {{ $cert->status !== 'pending' ? 'btn-disabled opacity-50' : '' }}"
                                                    onclick="{{ $cert->status === 'pending' ? "openStatusModal($cert->id, 'approved')" : '' }}"
                                                    {{ $cert->status !== 'pending' ? 'disabled' : '' }}>
                                                    ✔ Approve
                                                </button>

                                                <!-- Reject -->
                                                <button
                                                    class="btn btn-xs btn-error btn-outline {{ $cert->status !== 'pending' ? 'btn-disabled opacity-50' : '' }}"
                                                    onclick="{{ $cert->status === 'pending' ? "openStatusModal($cert->id, 'rejected')" : '' }}"
                                                    {{ $cert->status !== 'pending' ? 'disabled' : '' }}>
                                                    ✖ Reject
                                                </button>

                                                <!-- Edit Status -->
                                                <button
                                                    class="btn btn-xs btn-warning"
                                                    onclick="openStatusModal({{ $cert->id }}, 'edit')">
                                                    ✏ Edit
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7"
                                            class="text-center py-12 text-base-content/60">
                                            No certification requests found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <!-- Pagination -->
            @if ($certifications->hasPages())
                <div class="mt-6 flex justify-center">
                    {{ $certifications->links() }}
                </div>
            @endif

        </div>
    </div>

    <!-- STATUS MODAL -->
    <dialog id="status-modal"
        class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="font-bold text-xl mb-4"
                id="modal-title">
                Update Status
            </h3>

            <form method="POST"
                id="status-form">
                @csrf

                <!-- Edit status -->
                <div id="edit-status-container"
                    class="hidden mb-4">
                    <label class="label font-semibold">Select Status</label>
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
                        class="btn btn-primary">
                        Confirm
                    </button>
                    <button type="button"
                        class="btn"
                        onclick="document.getElementById('status-modal').close()">
                        Cancel
                    </button>
                </div>
            </form>
        </div>

        <form method="dialog"
            class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <script>
        function openStatusModal(certId, action) {
            const modal = document.getElementById('status-modal');
            const form = document.getElementById('status-form');
            const modalTitle = document.getElementById('modal-title');
            const editContainer = document.getElementById('edit-status-container');

            let route = "";

            if (action === 'approved') {
                modalTitle.innerText = `Approve Certification #${certId}?`;
                route = `/admin/certifications/${certId}/approve`;
                editContainer.classList.add('hidden');
            } else if (action === 'rejected') {
                modalTitle.innerText = `Reject Certification #${certId}?`;
                route = `/admin/certifications/${certId}/reject`;
                editContainer.classList.add('hidden');
            } else {
                modalTitle.innerText = `Edit Status for Certification #${certId}`;
                route = `/admin/certifications/${certId}/status`;
                editContainer.classList.remove('hidden');
            }

            form.action = route;
            modal.showModal();
        }
    </script>

</x-layouts.app>
