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

                    @if (
                        $freelancerInfo &&
                            ($freelancerInfo->facebook ||
                                $freelancerInfo->instagram ||
                                $freelancerInfo->linkedin ||
                                $freelancerInfo->twitter))
                        <div
                            class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                            <div class="card-body">
                                <h2
                                    class="card-title text-2xl mb-4 flex items-center gap-2">
                                    <span class="text-3xl">🌐</span>
                                    Social Links
                                </h2>
                                <div class="space-y-3">
                                    @if ($freelancerInfo->facebook)
                                        <a href="{{ $freelancerInfo->facebook }}"
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

                                    @if ($freelancerInfo->instagram)
                                        <a href="{{ $freelancerInfo->instagram }}"
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

                                    @if ($freelancerInfo->linkedin)
                                        <a href="{{ $freelancerInfo->linkedin }}"
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

                                    @if ($freelancerInfo->twitter)
                                        <a href="{{ $freelancerInfo->twitter }}"
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

                                    {{-- Share location --}}
                                    <button id="shareLocation"
                                        class="btn btn-primary btn-block gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Share My Location
                                    </button>

                                    {{-- Disable location button --}}
                                    @if (Auth::user()->latitude && Auth::user()->longitude)
                                        <button id="disableLocation"
                                            class="btn btn-outline btn-error btn-block gap-2 mt-2">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Disable Location
                                        </button>
                                    @endif

                                    <p id="locationStatus"
                                        class="text-sm text-gray-500"></p>
                                    <div id="locationCoordinates"
                                        class="mt-2">
                                        <p
                                            class="text-sm font-medium text-gray-700">
                                            Stored Location:</p>
                                        <p class="text-sm text-gray-600">
                                            Latitude:
                                            <span id="latitude"
                                                class="font-semibold">
                                                {{ Auth::user()->latitude ?? 'N/A' }}</span>
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            Longitude:
                                            <span id="longitude"
                                                class="font-semibold">
                                                {{ Auth::user()->longitude ?? 'N/A' }}</span>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Column - Main Content -->
                <div class="md:col-span-2 space-y-6">

                    {{-- Ai summary --}}
                    @if (Auth::check())
                        <div
                            class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300 mb-6">
                            <div class="card-body">
                                <h2
                                    class="card-title text-2xl mb-4 flex items-center gap-2">
                                    <span class="text-3xl">🤖</span>
                                    @if (Auth::id() === $user->id)
                                        My Profile Analysis
                                    @else
                                        Profile Analysis
                                    @endif
                                </h2>
                                @include('partials.ai-profile-analysis')
                            </div>
                        </div>
                    @endif

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

    <script>
        // Share Location
        document.getElementById('shareLocation').addEventListener('click', () => {
            const statusElement = document.getElementById('locationStatus');
            const coordinatesDiv = document.getElementById(
                'locationCoordinates');

            if (!navigator.geolocation) {
                alert("Geolocation is not supported.");
                return;
            }

            statusElement.innerText = "Getting location...";
            statusElement.classList.remove('text-green-600',
            'text-red-600');

            navigator.geolocation.getCurrentPosition(
                position => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    fetch('/freelancer/location', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                latitude: latitude,
                                longitude: longitude
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            // Display the coordinates
                            document.getElementById('latitude')
                                .innerText = latitude.toFixed(6);
                            document.getElementById('longitude')
                                .innerText = longitude.toFixed(6);
                            coordinatesDiv.classList.remove(
                                'hidden');

                            // Update status
                            statusElement.innerText =
                                "📍 Location shared successfully";
                            statusElement.classList.add(
                                'text-green-600');

                            // Reload page to show disable button
                            setTimeout(() => window.location
                            .reload(), 1000);
                        })
                        .catch(error => {
                            statusElement.innerText =
                                "Error saving location";
                            statusElement.classList.add(
                                'text-red-600');
                            coordinatesDiv.classList.add('hidden');
                        });
                },
                error => {
                    statusElement.innerText =
                        "Location permission denied";
                    statusElement.classList.add('text-red-600');
                    coordinatesDiv.classList.add('hidden');
                }
            );
        });

        // Disable Location
        const disableBtn = document.getElementById('disableLocation');
        if (disableBtn) {
            disableBtn.addEventListener('click', () => {
                if (!confirm(
                        'Are you sure you want to disable location sharing?'
                        )) {
                    return;
                }

                const statusElement = document.getElementById(
                    'locationStatus');
                statusElement.innerText = "Disabling location...";
                statusElement.classList.remove('text-green-600',
                    'text-red-600');

                // Use your existing LocationController route
                fetch('/location/disable', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        // Update UI
                        document.getElementById('latitude').innerText =
                            'N/A';
                        document.getElementById('longitude').innerText =
                            'N/A';

                        statusElement.innerText = "❌ Location disabled";
                        statusElement.classList.add('text-red-600');

                        // Reload page to hide disable button
                        setTimeout(() => window.location.reload(),
                        1000);
                    })
                    .catch(error => {
                        statusElement.innerText =
                            "Error disabling location";
                        statusElement.classList.add('text-red-600');
                    });
            });
        }
    </script>

</x-layouts.app>
