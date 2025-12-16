<x-layouts.app>
    <div class="min-h-screen bg-linear-to-br from-base-200 via-base-100 to-base-200 py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Page Header -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="bg-primary/10 p-3 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                        <div >
                            <h1 class="text-4xl font-bold bg-linear-to-r from-primary to-secondary bg-clip-text text-transparent">
                                Users
                            </h1>
                            <p class="text-base-content/70 text-sm mt-1">View and manage all platform users</p>
                        </div>
                    </div>

                    <!-- Filter/Stats Summary -->
                    <div class="stats shadow-lg bg-base-100 border-2 border-base-300">
                        <div class="stat py-3 px-4">
                            <div class="stat-title text-xs">Total Users</div>
                            <div class="stat-value text-2xl text-primary">{{ $users->total() }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div class="alert alert-success mb-6 shadow-lg border-2 border-success/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @elseif (session('error'))
                <div class="alert alert-error mb-6 shadow-lg border-2 border-error/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Users Table Card -->
            <div class="card bg-base-100 shadow-xl border-2 border-base-300">
                <div class="card-body p-0">
                    <!-- Desktop Table View -->
                    <div class="hidden lg:block overflow-x-auto">
                        <table class="table table-zebra">
                            <thead class="bg-base-200">
                                <tr>
                                    <th class="text-left font-bold">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                            </svg>
                                            ID
                                        </div>
                                    </th>
                                    <th class="text-left font-bold">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            User Details
                                        </div>
                                    </th>
                                    <th class="text-left font-bold">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            Role
                                        </div>
                                    </th>
                                    <th class="text-left font-bold">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Status
                                        </div>
                                    </th>
                                    <th class="text-right font-bold">
                                        <div class="flex items-center justify-end gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                            </svg>
                                            Actions
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr class="hover:bg-base-200/50 transition-colors">
                                        <td class="font-mono text-sm">
                                            <div class="badge badge-ghost badge-sm">{{ $user->id }}</div>
                                        </td>
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <div class="avatar avatar-placeholder">
                                                    <div class="bg-primary text-primary-content rounded-full w-10">
                                                        <span class="text-sm font-bold">{{ substr($user->name, 0, 2) }}</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="font-bold text-base-content">{{ $user->name }}</div>
                                                    <div class="text-sm text-base-content/60">{{ $user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($user->role === 'admin')
                                                <span class="badge badge-error gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                    </svg>
                                                    Admin
                                                </span>
                                            @elseif($user->role === 'freelancer')
                                                <span class="badge badge-info gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                    </svg>
                                                    Freelancer
                                                </span>
                                            @else
                                                <span class="badge badge-success gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                    </svg>
                                                    Client
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->trashed())
                                                <span class="badge badge-error gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                    </svg>
                                                    Deleted
                                                </span>
                                            @else
                                                <span class="badge badge-success gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Active
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="flex justify-end gap-2">
                                                @if ($user->trashed())
                                                    <form method="POST" action="{{ route('users.restore', $user->id) }}">
                                                        @csrf
                                                        <button class="btn btn-sm btn-success gap-2" onclick="return confirm('Restore {{ $user->name }}?')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                            </svg>
                                                            Restore
                                                        </button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-sm btn-primary gap-2" onclick="document.getElementById('editModal{{ $user->id }}').showModal()">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit
                                                    </button>

                                                    <form method="POST" action="{{ route('admin.users.resetPassword', $user) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn btn-sm btn-warning gap-2" onclick="return confirm('Reset password for {{ $user->name }}?')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                                            </svg>
                                                            Reset
                                                        </button>
                                                    </form>

                                                    <form method="POST" action="{{ route('admin.users.delete', $user) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-error gap-2" onclick="return confirm('Delete {{ $user->name }}?')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Edit Modal --}}
                                    <dialog id="editModal{{ $user->id }}" class="modal">
                                        <div class="modal-box max-w-md border-2 border-base-300">
                                            <div class="flex items-center gap-3 mb-6">
                                                <div class="bg-primary/10 p-2 rounded-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </div>
                                                <h3 class="text-xl font-bold">Edit User</h3>
                                            </div>

                                            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
                                                @csrf
                                                @method('PUT')

                                                <div class="form-control">
                                                    <label class="label">
                                                        <span class="label-text font-semibold">Name</span>
                                                    </label>
                                                    <input type="text" name="name" value="{{ $user->name }}" class="input input-bordered w-full focus:input-primary" required>
                                                </div>

                                                <div class="form-control">
                                                    <label class="label">
                                                        <span class="label-text font-semibold">Email</span>
                                                    </label>
                                                    <input type="email" name="email" value="{{ $user->email }}" class="input input-bordered w-full focus:input-primary" required>
                                                </div>

                                                <div class="form-control">
                                                    <label class="label">
                                                        <span class="label-text font-semibold">Role</span>
                                                    </label>
                                                    <select name="role" class="select select-bordered w-full focus:select-primary">
                                                        <option value="admin" @selected($user->role == 'admin')>👑 Admin</option>
                                                        <option value="freelancer" @selected($user->role == 'freelancer')>💼 Freelancer</option>
                                                        <option value="client" @selected($user->role == 'client')>🏢 Client</option>
                                                    </select>
                                                </div>

                                                <div class="modal-action">
                                                    <button type="submit" class="btn btn-primary gap-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        Save Changes
                                                    </button>
                                                    <button type="button" onclick="document.getElementById('editModal{{ $user->id }}').close()" class="btn btn-ghost">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                        <form method="dialog" class="modal-backdrop">
                                            <button>close</button>
                                        </form>
                                    </dialog>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-12">
                                            <div class="flex flex-col items-center gap-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-base-content/20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                <p class="text-base-content/60 font-medium">No users found</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="lg:hidden p-4 space-y-4">
                        @forelse ($users as $user)
                            <div class="card bg-base-200 shadow-lg border-2 border-base-300 hover:border-primary/30 transition-all">
                                <div class="card-body p-4">
                                    <div class="flex items-start gap-3 mb-3">
                                        <div class="avatar placeholder">
                                            <div class="bg-primary text-primary-content rounded-full w-12">
                                                <span class="font-bold">{{ substr($user->name, 0, 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="font-bold text-base-content">{{ $user->name }}</h3>
                                            <p class="text-sm text-base-content/60">{{ $user->email }}</p>
                                            <div class="flex gap-2 mt-2">
                                                @if($user->role === 'admin')
                                                    <span class="badge badge-error badge-sm">Admin</span>
                                                @elseif($user->role === 'freelancer')
                                                    <span class="badge badge-info badge-sm">Freelancer</span>
                                                @else
                                                    <span class="badge badge-success badge-sm">Client</span>
                                                @endif

                                                @if ($user->trashed())
                                                    <span class="badge badge-error badge-sm">Deleted</span>
                                                @else
                                                    <span class="badge badge-success badge-sm">Active</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-wrap gap-2">
                                        @if ($user->trashed())
                                            <form method="POST" action="{{ route('users.restore', $user->id) }}" class="flex-1">
                                                @csrf
                                                <button class="btn btn-sm btn-success w-full" onclick="return confirm('Restore {{ $user->name }}?')">
                                                    Restore
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-sm btn-primary flex-1" onclick="document.getElementById('editModal{{ $user->id }}').showModal()">
                                                Edit
                                            </button>

                                            <form method="POST" action="{{ route('admin.users.resetPassword', $user) }}" class="flex-1">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-sm btn-warning w-full" onclick="return confirm('Reset password for {{ $user->name }}?')">
                                                    Reset
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('admin.users.delete', $user) }}" class="flex-1">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-error w-full" onclick="return confirm('Delete {{ $user->name }}?')">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-base-content/20 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <p class="text-base-content/60 font-medium mt-3">No users found</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
                <div class="mt-6 flex justify-center">
                    <div class="join">
                        {{ $users->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>