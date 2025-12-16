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
                class="card bg-linear-to-br from-primary/10 via-base-100 to-secondary/10 shadow-2xl mb-6 overflow-hidden">
                <div
                    class="absolute top-0 left-0 w-full h-2 bg-linear-to-r from-primary via-secondary to-accent">
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
                                class="text-4xl md:text-5xl font-bold bg-linear-to-r from-primary to-secondary bg-clip-text text-transparent mb-2">
                                {{ $user->name }}
                            </h1>
                            <div
                                class="flex flex-wrap gap-3 justify-center md:justify-start items-center mt-3">
                                <span
                                    class="badge badge-lg badge-primary gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    {{ ucfirst($user->role) }}
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
                                    {{ $user->created_at->format('F Y') }}
                                </span>
                            </div>

                            <!-- Rating with Enhanced Design -->
                            @if ($averageRating)
                                <div
                                    class="mt-4 inline-flex items-center gap-2 bg-warning/20 px-4 py-2 rounded-full">
                                    <div class="rating rating-sm">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <input type="radio"
                                                class="mask mask-star-2 bg-warning"
                                                disabled
                                                {{ $i <= round($averageRating) ? 'checked' : '' }} />
                                        @endfor
                                    </div>
                                    <span
                                        class="text-lg font-bold text-warning">{{ number_format($averageRating, 1) }}</span>
                                    <span class="text-sm opacity-70">/
                                        5.0</span>
                                </div>
                            @else
                                <div
                                    class="mt-4 inline-flex items-center gap-2 bg-base-200 px-4 py-2 rounded-full">
                                    <span class="text-base-content/60">⭐ No
                                        ratings yet</span>
                                </div>
                            @endif

                            <!-- Message Button - Only show if viewing someone else's profile -->
                            @if (Auth::check() && Auth::id() !== $user->id)
                                <div class="mt-4">
                                    <a href="{{ route('chat.show', $user->id) }}"
                                        class="btn btn-primary btn-lg gap-2 shadow-lg hover:shadow-xl transition-all">
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
                <!-- Left Column - Contact & Quick Info -->
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
                                            {{ $user->email }}</p>
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
                                            {{ $freelancerInfo->contact_number ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Skills Card -->
                    <div
                        class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                        <div class="card-body">
                            <h2
                                class="card-title text-2xl mb-4 flex items-center gap-2">
                                <span class="text-3xl">💡</span>
                                Skills
                            </h2>
                            @if (!empty($freelancerInfo->skills))
                                <div class="flex flex-wrap gap-2">
                                    @foreach (explode(',', $freelancerInfo->skills) as $skill)
                                        <span
                                            class="badge badge-lg badge-outline hover:badge-primary transition-colors cursor-default">
                                            {{ trim($skill) }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-base-content/50 italic">No skills
                                    added yet</p>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons Card -->
                    @if (Auth::user()->id === $user->id)
                        <div
                            class="card bg-linear-to-br from-primary/5 to-secondary/5 shadow-xl hover:shadow-2xl transition-shadow duration-300">
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
                                    <a href="{{ route('freelancer.profile.edit') }}"
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
                    <!-- About Section -->
                    <div
                        class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                        <div class="card-body">
                            <h2
                                class="card-title text-2xl mb-4 flex items-center gap-2">
                                <span class="text-3xl">📝</span>
                                About Me
                            </h2>
                            <p
                                class="text-base-content/80 leading-relaxed text-lg">
                                {{ $freelancerInfo->about_me ?? 'No description available.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Certifications -->
                    <div
                        class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                        <div class="card-body">
                            <h2
                                class="card-title text-2xl mb-4 flex items-center gap-2">
                                <span class="text-3xl">🏅</span>
                                Certifications
                            </h2>

                            @if ($certifications->isNotEmpty())
                                <div class="space-y-4">
                                    @foreach ($certifications as $cert)
                                        <div
                                            class="group relative overflow-hidden rounded-xl bg-linear-to-br from-base-200 to-base-300 p-5 hover:shadow-lg transition-all duration-300">
                                            <div
                                                class="flex flex-col md:flex-row justify-between items-start gap-4">
                                                <div class="flex-1">
                                                    <div
                                                        class="flex items-start gap-3">
                                                        <span
                                                            class="text-2xl mt-1">🎖️</span>
                                                        <div>
                                                            <h3
                                                                class="font-bold text-lg mb-1">
                                                                {{ Str::limit($cert->type, 50) }}
                                                            </h3>
                                                            <p
                                                                class="text-sm text-base-content/70 mb-2">
                                                                {{ Str::limit($cert->description ?? 'No description provided.', 100) }}
                                                            </p>
                                                            <p
                                                                class="text-xs text-base-content/50">
                                                                📅
                                                                {{ $cert->created_at->format('M d, Y') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div
                                                    class="flex flex-col gap-2">
                                                    <div
                                                        class="badge badge-outline badge-success gap-1 badge-lg">
                                                        ✅ Verified
                                                    </div>
                                                    <a href="{{ Storage::url($cert->document_path) }}"
                                                        target="_blank"
                                                        class="btn btn-sm btn-primary gap-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-4 w-4"
                                                            fill="none"
                                                            viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        View
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <span class="text-6xl opacity-20">🏅</span>
                                    <p class="text-base-content/50 mt-4">No
                                        approved certifications yet</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Experience -->
                    <div
                        class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                        <div class="card-body">
                            <h2
                                class="card-title text-2xl mb-4 flex items-center gap-2">
                                <span class="text-3xl">💼</span>
                                Experience
                            </h2>
                            @php
                                $experiences = !empty(
                                    $freelancerInfo->experiences
                                )
                                    ? $freelancerInfo->experiences
                                    : [];
                            @endphp
                            @if (!empty($experiences))
                                <div class="space-y-4">
                                    @foreach ($experiences as $exp)
                                        <div
                                            class="relative pl-8 pb-6 border-l-2 border-primary/30 last:pb-0">
                                            <div
                                                class="absolute left-[-9px] top-0 w-4 h-4 rounded-full bg-primary ring-4 ring-base-100">
                                            </div>
                                            <div
                                                class="bg-base-200 rounded-lg p-4 hover:bg-base-300 transition-colors">
                                                <h3
                                                    class="font-bold text-lg text-primary">
                                                    {{ $exp['job_title'] ?? 'N/A' }}
                                                </h3>
                                                <p
                                                    class="text-sm opacity-70 mb-2">
                                                    {{ $exp['company'] ?? 'N/A' }}
                                                </p>
                                                <p
                                                    class="text-xs badge badge-ghost mb-3">
                                                    {{ $exp['start_date'] ?? 'N/A' }}
                                                    -
                                                    {{ $exp['end_date'] ?? 'Present' }}
                                                </p>
                                                <p class="text-sm">
                                                    {{ $exp['description'] ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <span class="text-6xl opacity-20">💼</span>
                                    <p class="text-base-content/50 mt-4">No
                                        experiences listed</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Education -->
                    <div
                        class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                        <div class="card-body">
                            <h2
                                class="card-title text-2xl mb-4 flex items-center gap-2">
                                <span class="text-3xl">🎓</span>
                                Education
                            </h2>
                            @php
                                $education = !empty($freelancerInfo->education)
                                    ? $freelancerInfo->education
                                    : [];
                            @endphp
                            @if (!empty($education))
                                <div class="space-y-4">
                                    @foreach ($education as $edu)
                                        <div
                                            class="bg-linear-to-br from-base-200 to-base-300 rounded-lg p-5 hover:shadow-md transition-all">
                                            <div
                                                class="flex items-start gap-3">
                                                <span
                                                    class="text-3xl">📚</span>
                                                <div class="flex-1">
                                                    <h3
                                                        class="font-bold text-lg mb-1">
                                                        {{ $edu['degree'] ?? 'N/A' }}
                                                    </h3>
                                                    <p
                                                        class="text-base-content/80 mb-1">
                                                        {{ $edu['school'] ?? 'N/A' }}
                                                    </p>
                                                    <p
                                                        class="text-sm text-base-content/60 mb-2">
                                                        {{ $edu['field_of_study'] ?? 'N/A' }}
                                                    </p>
                                                    <div
                                                        class="flex flex-wrap gap-2 items-center">
                                                        <span
                                                            class="badge badge-outline badge-sm">
                                                            {{ $edu['start_year'] ?? 'N/A' }}
                                                            -
                                                            {{ $edu['end_year'] ?? 'Present' }}
                                                        </span>
                                                        @if (!empty($edu['awards']))
                                                            <span
                                                                class="badge badge-warning badge-sm gap-1">
                                                                🏆
                                                                {{ $edu['awards'] }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <span class="text-6xl opacity-20">🎓</span>
                                    <p class="text-base-content/50 mt-4">No
                                        education added yet</p>
                                </div>
                            @endif
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

            @if (session('success'))
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
            @endif

            <form method="POST"
                action="{{ route('freelancer.profile.changePassword') }}">
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
