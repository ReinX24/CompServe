<x-layouts.app>
    <div
        class="min-h-screen bg-gradient-to-br from-base-200 via-base-100 to-base-200 py-12 px-4">
        <div class="max-w-5xl mx-auto">
            <!-- Profile Header Card with Gradient -->
            <div
                class="card bg-gradient-to-br from-secondary/10 via-base-100 to-accent/10 shadow-2xl mb-6 overflow-hidden">
                <div
                    class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-secondary via-accent to-primary">
                </div>

                <div class="card-body p-8">
                    <div
                        class="flex flex-col md:flex-row items-center md:items-start gap-8">
                        <!-- Enhanced Avatar with Glow Effect -->
                        <div class="relative group">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-secondary to-accent rounded-full blur-xl opacity-50 group-hover:opacity-75 transition-opacity duration-300">
                            </div>
                            <div class="avatar relative">
                                <div
                                    class="w-36 rounded-full ring ring-secondary ring-offset-base-100 ring-offset-4 shadow-xl">
                                    <div
                                        class="flex items-center justify-center w-full h-full bg-gradient-to-br from-secondary to-accent text-secondary-content text-5xl font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Info -->
                        <div class="flex-1 text-center md:text-left">
                            <h1
                                class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-secondary to-accent bg-clip-text text-transparent mb-2">
                                {{ $user->name }}
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
                        </div>
                    </div>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Left Column - Contact & Company Quick Info -->
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
                                            {{ $profile->contact_number ?? 'Not set' }}
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-start gap-3 p-3 rounded-lg hover:bg-base-200 transition-colors">
                                    <span class="text-xl">🕒</span>
                                    <div class="flex-1">
                                        <p
                                            class="text-xs uppercase opacity-60 mb-1">
                                            Last Active</p>
                                        <p class="font-medium">
                                            {{ $user->updated_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Company Quick Info Card -->
                    <div
                        class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                        <div class="card-body">
                            <h2
                                class="card-title text-2xl mb-4 flex items-center gap-2">
                                <span class="text-3xl">🏢</span>
                                Quick Info
                            </h2>
                            <div class="space-y-4">
                                <div class="p-3 rounded-lg bg-base-200">
                                    <p
                                        class="text-xs uppercase opacity-60 mb-1">
                                        Location</p>
                                    <p
                                        class="font-medium flex items-center gap-2">
                                        <span>📍</span>
                                        {{ $profile->location ?? 'Not set' }}
                                    </p>
                                </div>
                                @if (!empty($profile->website))
                                    <div class="p-3 rounded-lg bg-base-200">
                                        <p
                                            class="text-xs uppercase opacity-60 mb-1">
                                            Website</p>
                                        <a href="{{ $profile->website }}"
                                            target="_blank"
                                            class="font-medium text-secondary hover:text-accent flex items-center gap-2 break-all transition-colors">
                                            <span>🌐</span>
                                            <span
                                                class="truncate">{{ $profile->website }}</span>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Main Content -->
                <div class="md:col-span-2 space-y-6">
                    <!-- Company Information -->
                    <div
                        class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                        <div class="card-body">
                            <h2
                                class="card-title text-2xl mb-4 flex items-center gap-2">
                                <span class="text-3xl">🏢</span>
                                Company Information
                            </h2>
                            <div class="grid gap-4">
                                <div
                                    class="bg-gradient-to-br from-base-200 to-base-300 rounded-lg p-5 hover:shadow-md transition-all">
                                    <div class="flex items-start gap-3">
                                        <span class="text-2xl mt-1">🏷️</span>
                                        <div class="flex-1">
                                            <p
                                                class="text-xs uppercase opacity-60 mb-1">
                                                Company Name</p>
                                            <p class="font-bold text-lg">
                                                {{ $profile->company_name ?? 'Not set' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-2 gap-4">
                                    <div
                                        class="bg-base-200 rounded-lg p-4 hover:bg-base-300 transition-colors">
                                        <div
                                            class="flex items-center gap-2 mb-2">
                                            <span class="text-xl">🌐</span>
                                            <p
                                                class="text-xs uppercase opacity-60">
                                                Website</p>
                                        </div>
                                        @if (!empty($profile->website))
                                            <a href="{{ $profile->website }}"
                                                target="_blank"
                                                class="font-medium text-secondary hover:text-accent transition-colors break-all">
                                                {{ $profile->website }}
                                            </a>
                                        @else
                                            <p
                                                class="text-base-content/50 italic text-sm">
                                                Not set</p>
                                        @endif
                                    </div>

                                    <div
                                        class="bg-base-200 rounded-lg p-4 hover:bg-base-300 transition-colors">
                                        <div
                                            class="flex items-center gap-2 mb-2">
                                            <span class="text-xl">📍</span>
                                            <p
                                                class="text-xs uppercase opacity-60">
                                                Location</p>
                                        </div>
                                        <p class="font-medium">
                                            {{ $profile->location ?? 'Not set' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- About Company -->
                    <div
                        class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                        <div class="card-body">
                            <h2
                                class="card-title text-2xl mb-4 flex items-center gap-2">
                                <span class="text-3xl">📋</span>
                                About the Company
                            </h2>
                            <div class="bg-base-200 rounded-lg p-6">
                                <p
                                    class="text-base-content/80 leading-relaxed text-lg">
                                    {{ $profile->bio ?? 'No company description added yet.' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Projects -->
                    <div
                        class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                        <div class="card-body">
                            <h2
                                class="card-title text-2xl mb-4 flex items-center gap-2">
                                <span class="text-3xl">🚀</span>
                                Recent Projects
                            </h2>
                            @if (!empty($profile->projects))
                                <div class="grid gap-3">
                                    @foreach (explode(',', $profile->projects) as $index => $project)
                                        <div
                                            class="flex items-start gap-4 p-4 bg-gradient-to-r from-base-200 to-base-300 rounded-lg hover:shadow-md transition-all group">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-secondary/20 flex items-center justify-center font-bold text-secondary group-hover:bg-secondary group-hover:text-secondary-content transition-colors">
                                                    {{ $index + 1 }}
                                                </div>
                                            </div>
                                            <div class="flex-1 pt-2">
                                                <p
                                                    class="font-medium text-base-content">
                                                    {{ trim($project) }}</p>
                                            </div>
                                            <div class="flex-shrink-0 pt-2">
                                                <span
                                                    class="text-xl opacity-0 group-hover:opacity-100 transition-opacity">✨</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <span class="text-6xl opacity-20">🚀</span>
                                    <p class="text-base-content/50 mt-4">No
                                        recent projects listed</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
