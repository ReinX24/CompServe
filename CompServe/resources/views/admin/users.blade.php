<x-layouts.app>
    <div class="container mx-auto px-4 md:px-6 py-6">
        <!-- Page Header -->
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <h1 class="text-3xl font-bold text-primary">👥 Manage Users</h1>
            <a href="{{ route('freelancer.certifications.create') }}"
                class="btn btn-outline btn-primary w-full md:w-auto">
                ➕ Add User
            </a>
        </div>

        <!-- Alerts -->
        @if (session('success'))
            <div class="alert alert-success mb-4 shadow-md">
                {{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-error mb-4 shadow-md">{{ session('error') }}
            </div>
        @endif

        <!-- Users Table / Cards -->
        <div class="overflow-x-auto">
            <table class="table w-full rounded-lg shadow-sm">
                <thead class="bg-base-200">
                    <tr>
                        <th class="text-left">#</th>
                        <th class="text-left">Name</th>
                        <th class="text-left hidden sm:table-cell">Email</th>
                        <th class="text-left">Role</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-base-100 transition-colors">
                            <td class="whitespace-normal">{{ $user->id }}
                            </td>
                            <td class="whitespace-normal font-semibold">
                                {{ $user->name }}</td>
                            <td class="whitespace-normal hidden sm:table-cell">
                                {{ $user->email }}</td>
                            <td>
                                <span class="badge badge-outline badge-primary">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td
                                class="text-right flex flex-col sm:flex-row sm:justify-end gap-2 mt-2 sm:mt-0">
                                {{-- Edit --}}
                                <button class="btn btn-sm btn-primary"
                                    onclick="document.getElementById('editModal{{ $user->id }}').showModal()">
                                    ✏️ Edit
                                </button>

                                {{-- Reset Password --}}
                                <form method="POST"
                                    action="{{ route('admin.users.resetPassword', $user) }}">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-sm btn-secondary"
                                        onclick="return confirm('Reset password for {{ $user->name }}?')">
                                        🔑 Reset
                                    </button>
                                </form>

                                {{-- Delete --}}
                                <form method="POST"
                                    action="{{ route('admin.users.delete', $user) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="btn btn-outline btn-sm btn-error"
                                        onclick="return confirm('Delete {{ $user->name }}? This cannot be undone.')">
                                        ❌ Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        {{-- Edit Modal --}}
                        <dialog id="editModal{{ $user->id }}"
                            class="modal">
                            <div class="modal-box max-w-md">
                                <h3 class="text-lg font-bold mb-3">Edit User
                                </h3>
                                <form method="POST"
                                    action="{{ route('admin.users.update', $user) }}"
                                    class="space-y-3">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label class="label"><span
                                                class="label-text">Name</span></label>
                                        <input type="text"
                                            name="name"
                                            value="{{ $user->name }}"
                                            class="input input-bordered w-full"
                                            required>
                                    </div>
                                    <div>
                                        <label class="label"><span
                                                class="label-text">Email</span></label>
                                        <input type="email"
                                            name="email"
                                            value="{{ $user->email }}"
                                            class="input input-bordered w-full"
                                            required>
                                    </div>
                                    <div>
                                        <label class="label"><span
                                                class="label-text">Role</span></label>
                                        <select name="role"
                                            class="select select-bordered w-full">
                                            <option value="admin"
                                                @selected($user->role == 'admin')>
                                                Admin</option>
                                            <option value="freelancer"
                                                @selected($user->role == 'freelancer')>
                                                Freelancer</option>
                                            <option value="client"
                                                @selected($user->role == 'client')>
                                                Client</option>
                                        </select>
                                    </div>
                                    <div class="modal-action">
                                        <button type="submit"
                                            class="btn btn-primary">Save</button>
                                        <button type="button"
                                            onclick="document.getElementById('editModal{{ $user->id }}').close()"
                                            class="btn btn-ghost">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </dialog>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-layouts.app>
