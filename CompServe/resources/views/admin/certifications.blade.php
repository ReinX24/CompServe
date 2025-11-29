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

        <!-- Certifications Table -->
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
                        <tr class="hover:bg-base-100 transition-colors">
                            <td>{{ $cert->id }}</td>
                            <td>{{ $cert->user->name ?? 'N/A' }}</td>
                            <td>{{ $cert->type }}</td>
                            <td>
                                @if ($cert->document_path)
                                    <a href="{{ Storage::url($cert->document_path) }}"
                                        target="_blank"
                                        class="text-primary underline">View</a>
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
                                class="text-right flex flex-col sm:flex-row sm:justify-end gap-2 mt-2 sm:mt-0">
                                <!-- Approve -->
                                @if ($cert->status === 'pending')
                                    <form method="POST"
                                        action="{{ route('admin.certifications.approve', $cert) }}">
                                        @csrf
                                        <button class="btn btn-sm btn-success">✅
                                            Approve</button>
                                    </form>

                                    <!-- Reject -->
                                    <form method="POST"
                                        action="{{ route('admin.certifications.reject', $cert) }}">
                                        @csrf
                                        <button
                                            class="btn btn-outline btn-sm btn-error">❌
                                            Reject</button>
                                    </form>
                                @endif
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
</x-layouts.app>
