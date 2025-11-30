<x-layouts.app>
    <div class="breadcrumbs text-sm mb-4">
        <ul class="text-base-content/70">
            <li><a href="{{ route('dashboard') }}"
                    class="hover:text-primary">Dashboard</a></li>
            <li class="text-primary font-semibold">My Certifications</li>
        </ul>
    </div>

    <!-- Page Header -->
    <div
        class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4 bg-base-200 p-5 rounded-xl shadow-sm border border-base-300">
        <div>
            <h1 class="text-2xl font-bold text-primary">
                🎓 My Certifications
            </h1>
            <p class="text-base-content/70 mt-1">
                Showcase your verified skills and qualifications ✨
            </p>
        </div>

        <a href="{{ route('freelancer.certifications.create') }}"
            class="btn btn-primary w-full md:w-auto flex items-center gap-2">
            ➕ Apply for Certification
        </a>
    </div>

    {{-- Success Message --}}
    @session('success')
        <div class="mb-4">
            <div role="alert"
                class="alert alert-success alert-soft text-lg flex items-center gap-2">
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

    <!-- Certifications Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($certifications as $cert)
            <x-freelancer.cert-card :cert="$cert" />
        @empty
            <div class="col-span-full">
                <div
                    class="alert alert-info shadow-sm rounded-xl flex items-center gap-3 p-4">
                    <span class="text-2xl">📭</span>
                    <span class="text-base-content">
                        No certifications found. You can apply for one
                        above.
                    </span>
                </div>
            </div>
        @endforelse
    </div>
</x-layouts.app>
