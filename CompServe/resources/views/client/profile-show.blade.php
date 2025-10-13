<x-layouts.app>
    <div class="max-w-4xl mx-auto p-6">
        <div class="card bg-base-100 dark:bg-base-200 shadow-xl">
            <div class="card-body">
                <!-- Header -->
                <div
                    class="flex flex-col md:flex-row items-center md:items-start gap-6 border-b border-base-300 pb-6">
                    <!-- Avatar -->
                    <div class="avatar">
                        <div
                            class="w-32 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                            <div
                                class="flex items-center justify-center w-full h-full bg-neutral text-neutral-content text-4xl font-bold">
                                {{ strtoupper(substr($user->name ?? Auth::user()->name, 0, 1)) }}
                            </div>
                        </div>
                    </div>

                    <!-- Basic Info -->
                    <div>
                        <h1 class="text-3xl font-bold text-base-content">
                            {{ $user->name ?? Auth::user()->name }}
                        </h1>
                        <p class="text-lg text-base-content/70 mt-1">
                            {{ ucfirst($user->role ?? 'Client') }}
                        </p>
                        <p class="text-sm text-base-content/50 mt-1">
                            Member since
                            {{ ($user->created_at ?? Auth::user()->created_at)->format('F Y') }}
                        </p>
                    </div>
                </div>

                <!-- Company Info -->
                <div class="mt-6">
                    <h2
                        class="text-xl font-semibold text-primary border-b border-base-300 pb-2 mb-4">
                        🏢 Company Information
                    </h2>
                    <div class="grid md:grid-cols-2 gap-4 text-base-content/80">
                        <p><span class="font-semibold">Company Name:</span>
                            {{ $profile->company_name ?? 'Not set' }}</p>
                        <p><span class="font-semibold">Website:</span>
                            {{ $profile->website ?? 'Not set' }}</p>
                        <p><span class="font-semibold">Location:</span>
                            {{ $profile->location ?? 'Not set' }}</p>
                    </div>
                </div>

                <div class="divider"></div>

                <!-- Contact Info -->
                <div class="mt-6">
                    <h2
                        class="text-xl font-semibold text-primary border-b border-base-300 pb-2 mb-4">
                        📞 Contact Information
                    </h2>
                    <div class="space-y-2 text-base-content/80">
                        <p><span class="font-semibold">Email:</span>
                            {{ $user->email ?? Auth::user()->email }}</p>
                        <p><span class="font-semibold">Contact Number:</span>
                            {{ $profile->contact_number ?? 'Not set' }}</p>
                        <p><span class="font-semibold">Last Updated:</span>
                            {{ $user->updated_at->diffForHumans() }}</p>
                    </div>
                </div>

                <div class="divider"></div>

                <!-- About Company -->
                <div class="mt-6">
                    <h2
                        class="text-xl font-semibold text-primary border-b border-base-300 pb-2 mb-4">
                        🧾 About the Company
                    </h2>
                    <p class="text-base-content/80 leading-relaxed">
                        {{ $profile->bio ?? 'No company description added yet.' }}
                    </p>
                </div>

                <!-- Projects (optional) -->
                @if (!empty($profile->projects))
                    <div class="divider"></div>
                    <div class="mt-6">
                        <h2
                            class="text-xl font-semibold text-primary border-b border-base-300 pb-2 mb-4">
                            🚀 Recent Projects
                        </h2>
                        <ul
                            class="list-disc list-inside space-y-1 text-base-content/80">
                            @foreach (explode(',', $profile->projects) as $project)
                                <li>{{ trim($project) }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Edit Button -->
                <div class="mt-8 text-center">
                    <a href="{{ route('client.profile.edit') }}"
                        class="btn btn-primary btn-wide">
                        Edit Information
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
