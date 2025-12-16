<x-layouts.app>

    <div class="breadcrumbs text-sm mb-4">
        <ul class="text-base-content/70">
            <li><a href="{{ route('dashboard') }}"
                    class="hover:text-primary">Dashboard</a></li>
            <li class="text-primary font-semibold">Profile</li>
        </ul>
    </div>

    <div
        class="min-h-screen bg-linear-to-br from-base-200 via-base-100 to-base-200 py-12 px-4">
        <div class="max-w-5xl mx-auto">
            <!-- Profile Header Card with Gradient -->
            <div
                class="card bg-linear-to-br from-secondary/10 via-base-100 to-accent/10 shadow-2xl mb-6 overflow-hidden">
                <div
                    class="absolute top-0 left-0 w-full h-2 bg-linear-to-r from-secondary via-accent to-primary">
                </div>

                <div class="card-body p-8">
                    <div
                        class="flex flex-col md:flex-row items-center md:items-start gap-8">
                        <!-- Enhanced Avatar with Glow Effect -->
                        <div class="relative group">
                            <div
                                class="absolute inset-0 bg-linear-to-r from-secondary to-accent rounded-full blur-xl opacity-50 group-hover:opacity-75 transition-opacity duration-300">
                            </div>

                            <div class="avatar relative">
                                <div
                                    class="w-36 rounded-full ring ring-secondary ring-offset-base-100 ring-offset-4 shadow-xl overflow-hidden">

                                    @if (!empty($user->profile_photo))
                                        <!-- Profile Photo -->
                                        <img src="{{ asset('storage/' . $user->profile_photo) }}"
                                            alt="{{ $user->name }} profile photo"
                                            class="w-full h-full object-cover" />
                                    @else
                                        <!-- Fallback Initial -->
                                        <div
                                            class="flex items-center justify-center w-full h-full
                           bg-linear-to-br from-secondary to-accent
                           text-secondary-content text-5xl font-bold">
                                            {{ strtoupper(substr($user->name ?? Auth::user()->name, 0, 1)) }}
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>


                        <!-- Profile Info -->
                        <div class="flex-1 text-center md:text-left">
                            <h1
                                class="text-4xl md:text-5xl font-bold bg-linear-to-r from-secondary to-accent bg-clip-text text-transparent mb-2">
                                {{ $user->name ?? Auth::user()->name }}
                            </h1>
                            <div
                                class="flex flex-wrap gap-3 justify-center md:justify-start items-center mt-3">
                                <span
                                    class="badge badge-lg badge-secondary gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    {{ ucfirst($user->role ?? 'Client') }}
                                </span>
                                <span class="badge badge-lg badge-ghost gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Member since
                                    {{ ($user->created_at ?? Auth::user()->created_at)->format('F Y') }}
                                </span>
                            </div>

                            <!-- Message Button - Only show if viewing someone else's profile -->
                            @if (Auth::check() && Auth::id() !== $user->id)
                                <div class="mt-4">
                                    <a href="{{ route('chat.show', $user->id) }}"
                                        class="btn btn-secondary btn-lg gap-2 shadow-lg hover:shadow-xl transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-6 w-6"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        Send Message
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Left Column - Contact & Social Links -->
                <div class="md:col-span-1 space-y-6">
                    <!-- Contact Card -->
                    <div
                        class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                        <div class="card-body">
                            <h2
                                class="card-title text-2xl mb-4 flex items-center gap-2">
                                <span class="text-3xl">📞</span>
                                Contact
                            </h2>
                            <div class="space-y-4">
                                <div
                                    class="flex items-start gap-3 p-3 rounded-lg hover:bg-base-200 transition-colors">
                                    <span class="text-xl">✉️</span>
                                    <div class="flex-1 min-w-0">
                                        <p
                                            class="text-xs uppercase opacity-60 mb-1">
                                            Email</p>
                                        <p class="font-medium break-all">
                                            {{ $user->email ?? Auth::user()->email }}
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-start gap-3 p-3 rounded-lg hover:bg-base-200 transition-colors">
                                    <span class="text-xl">📱</span>
                                    <div class="flex-1">
                                        <p
                                            class="text-xs uppercase opacity-60 mb-1">
                                            Phone</p>
                                        <p class="font-medium">
                                            {{ $profile->contact_number ?? 'Not set' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Links Card -->
                    @if (
                        $profile &&
                            ($profile->facebook ||
                                $profile->instagram ||
                                $profile->linkedin ||
                                $profile->twitter))
                        <div
                            class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                            <div class="card-body">
                                <h2
                                    class="card-title text-2xl mb-4 flex items-center gap-2">
                                    <span class="text-3xl">🌐</span>
                                    Social Links
                                </h2>
                                <div class="space-y-3">
                                    @if ($profile->facebook)
                                        <a href="{{ $profile->facebook }}"
                                            target="_blank"
                                            class="flex items-center gap-3 p-3 rounded-lg hover:bg-base-200 transition-colors group">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-[#1877F2] flex items-center justify-center text-white">
                                                <svg class="w-5 h-5"
                                                    fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <p
                                                    class="font-medium group-hover:text-[#1877F2] transition-colors">
                                                    Facebook</p>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 opacity-50"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    @endif

                                    @if ($profile->instagram)
                                        <a href="{{ $profile->instagram }}"
                                            target="_blank"
                                            class="flex items-center gap-3 p-3 rounded-lg hover:bg-base-200 transition-colors group">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-linear-to-br from-[#833AB4] via-[#FD1D1D] to-[#F77737] flex items-center justify-center text-white">
                                                <svg class="w-5 h-5"
                                                    fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <p
                                                    class="font-medium group-hover:text-[#E4405F] transition-colors">
                                                    Instagram</p>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 opacity-50"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    @endif

                                    @if ($profile->linkedin)
                                        <a href="{{ $profile->linkedin }}"
                                            target="_blank"
                                            class="flex items-center gap-3 p-3 rounded-lg hover:bg-base-200 transition-colors group">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-[#0A66C2] flex items-center justify-center text-white">
                                                <svg class="w-5 h-5"
                                                    fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <p
                                                    class="font-medium group-hover:text-[#0A66C2] transition-colors">
                                                    LinkedIn</p>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 opacity-50"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    @endif

                                    @if ($profile->twitter)
                                        <a href="{{ $profile->twitter }}"
                                            target="_blank"
                                            class="flex items-center gap-3 p-3 rounded-lg hover:bg-base-200 transition-colors group">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-[#1DA1F2] flex items-center justify-center text-white">
                                                <svg class="w-5 h-5"
                                                    fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <p
                                                    class="font-medium group-hover:text-[#1DA1F2] transition-colors">
                                                    Twitter</p>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 opacity-50"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons Card -->
                    @if (Auth::user()->id === $user->id)
                        <div
                            class="card bg-linear-to-br from-secondary/5 to-accent/5 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                            <div class="card-body p-5">
                                <div class="flex flex-col gap-3">
                                    <label for="change-password-modal"
                                        class="btn btn-secondary btn-block gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        Change Password
                                    </label>
                                    <a href="{{ route('client.profile.edit') }}"
                                        class="btn btn-primary btn-block gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit Information
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Column - Main Content -->
                <div class="md:col-span-2 space-y-6">
                    <!-- About Me -->
                    <div
                        class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                        <div class="card-body">
                            <h2
                                class="card-title text-2xl mb-4 flex items-center gap-2">
                                <span class="text-3xl">📋</span>
                                About Me
                            </h2>
                            <div class="bg-base-200 rounded-lg p-6">
                                <p
                                    class="text-base-content/80 leading-relaxed text-lg">
                                    {{ $profile->about_me ?? 'No description added yet.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Change password modal --}}
    <input type="checkbox"
        id="change-password-modal"
        class="modal-toggle" />
    <div class="modal">
        <div class="modal-box relative max-w-md">
            <label for="change-password-modal"
                class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>

            <h3 class="text-2xl font-bold mb-6 flex items-center gap-2">
                <span class="text-3xl">🔐</span>
                Change Password
            </h3>

            @if ($errors->any())
                <div class="alert alert-error mb-4 shadow-lg">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="stroke-current shrink-0 h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- @if (session('success'))
                <div class="alert alert-success mb-4 shadow-lg">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="stroke-current shrink-0 h-6 w-6"
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
            @endif --}}

            <form method="POST"
                action="{{ route('client.profile.changePassword') }}">
                @csrf
                <div class="space-y-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Current
                                Password</span>
                        </label>
                        <input type="password"
                            name="current_password"
                            class="input input-bordered w-full"
                            required
                            placeholder="Enter current password">
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">New
                                Password</span>
                        </label>
                        <input type="password"
                            name="new_password"
                            class="input input-bordered w-full"
                            required
                            minlength="8"
                            placeholder="Enter new password">
                        <label class="label">
                            <span class="label-text-alt">Must be at least 8
                                characters</span>
                        </label>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Confirm New
                                Password</span>
                        </label>
                        <input type="password"
                            name="new_password_confirmation"
                            class="input input-bordered w-full"
                            required
                            minlength="8"
                            placeholder="Confirm new password">
                    </div>
                </div>

                <div class="modal-action">
                    <label for="change-password-modal"
                        class="btn btn-ghost">Cancel</label>
                    <button type="submit"
                        class="btn btn-primary gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
