<x-layouts.app>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Manage Users</h1>

        {{-- Success / Error messages --}}
        @if (session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-error mb-4">{{ session('error') }}</div>
        @endif

        <div class="overflow-x-auto bg-base-100 shadow-md rounded-lg">
            <table class="table w-full">
                <thead class="bg-base-200">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge badge-outline badge-primary">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="text-right space-x-2">

                                {{-- Edit Button --}}
                                <button class="btn btn-sm btn-info"
                                    onclick="document.getElementById('editModal{{ $user->id }}').showModal()">
                                    Edit
                                </button>

                                {{-- Reset Password Button --}}
                                <form method="POST"
                                    action="{{ route('admin.users.resetPassword', $user) }}"
                                    class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-sm btn-warning"
                                        onclick="return confirm('Reset password for {{ $user->name }}?')">
                                        Reset Password
                                    </button>
                                </form>

                                {{-- Delete Button --}}
                                <form method="POST"
                                    action="{{ route('admin.users.delete', $user) }}"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-error"
                                        onclick="return confirm('Delete {{ $user->name }}? This action cannot be undone.')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        {{-- 🟦 Edit Modal --}}
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
                                        <label class="label">
                                            <span class="label-text">Name</span>
                                        </label>
                                        <input type="text"
                                            name="name"
                                            value="{{ $user->name }}"
                                            class="input input-bordered w-full"
                                            required>
                                    </div>

                                    <div>
                                        <label class="label">
                                            <span
                                                class="label-text">Email</span>
                                        </label>
                                        <input type="email"
                                            name="email"
                                            value="{{ $user->email }}"
                                            class="input input-bordered w-full"
                                            required>
                                    </div>

                                    <div>
                                        <label class="label">
                                            <span class="label-text">Role</span>
                                        </label>
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
    </div>
</x-layouts.app>
