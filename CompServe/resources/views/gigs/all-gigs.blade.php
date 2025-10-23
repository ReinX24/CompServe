<x-layouts.app>
    {{-- Breadcrumbs --}}
    <div class="breadcrumbs text-sm mb-4">
        <ul class="text-base-content/70">
            <li><a href="{{ route('dashboard') }}"
                    class="hover:text-primary">Dashboard</a></li>
            <li class="text-primary font-semibold">All Gigs</li>
        </ul>
    </div>

    {{-- Page Header --}}
    <div
        class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 bg-base-200 dark:bg-base-300 p-5 rounded-xl shadow-sm">
        <div>
            <h1 class="text-2xl font-bold text-primary">
                {{ __('All Gigs') }}
            </h1>
            <p class="mt-1 text-base-content/70">
                {{ __('All your open, in progress, and completed gigs.') }}
            </p>
        </div>

        <div class="mt-3 md:mt-0">
            <a href="{{ route('client.jobs.create') }}"
                class="btn btn-primary shadow-md">
                + {{ __('Add Gig') }}
            </a>
        </div>
    </div>

    {{-- Section: Open Jobs --}}
    <div class="mb-10">
        <h2
            class="text-xl font-semibold mb-4 flex items-center gap-2 text-primary">
            <i class="fa-solid fa-briefcase"></i>
            {{ __('Open Gigs') }}
        </h2>

        @php $openJobs = $jobs->where('status', 'open')->sortByDesc('created_at')->take(3); @endphp

        @if ($openJobs->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($openJobs as $job)
                    <x-client.job-card :job="$job" />
                @endforeach
            </div>

            @if ($jobs->where('status', 'open')->count() > 3)
                <div class="mt-4 text-right">
                    <a href="{{ route('client.jobs.posts') }}"
                        class="link link-primary">
                        {{ __('See more open gigs →') }}
                    </a>
                </div>
            @endif
        @else
            <div class="alert alert-info shadow-sm mt-3">
                <span>{{ __('No open gigs found.') }}</span>
            </div>
        @endif
    </div>

    {{-- Section: In Progress Jobs --}}
    <div class="mb-10">
        <h2
            class="text-xl font-semibold mb-4 flex items-center gap-2 text-secondary">
            <i class="fa-solid fa-spinner animate-spin-slow"></i>
            {{ __('In Progress Gigs') }}
        </h2>

        @php $inProgressJobs = $jobs->where('status', 'in_progress')->sortByDesc('created_at')->take(3); @endphp

        @if ($inProgressJobs->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($inProgressJobs as $job)
                    <x-client.job-card :job="$job" />
                @endforeach
            </div>

            @if ($jobs->where('status', 'in_progress')->count() > 3)
                <div class="mt-4 text-right">
                    <a href="{{ route('client.jobs.in_progress') }}"
                        class="link link-secondary">
                        {{ __('See more in progress gigs →') }}
                    </a>
                </div>
            @endif
        @else
            <div class="alert alert-warning shadow-sm mt-3">
                <span>{{ __('No in progress jobs found.') }}</span>
            </div>
        @endif
    </div>

    {{-- Section: Cancelled Jobs --}}
    <div class="mb-10">
        <h2
            class="text-xl font-semibold mb-4 flex items-center gap-2 text-error">
            <i class="fa-solid fa-ban"></i>
            {{ __('Cancelled Jobs') }}
        </h2>

        @php $cancelledJobs = $jobs->where('status', 'cancelled')->sortByDesc('created_at')->take(3); @endphp

        @if ($cancelledJobs->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($cancelledJobs as $job)
                    <x-client.job-card :job="$job" />
                @endforeach
            </div>

            @if ($jobs->where('status', 'cancelled')->count() > 3)
                <div class="mt-4 text-right">
                    <a href="{{ route('client.jobs.cancelled') }}"
                        class="link link-error">
                        {{ __('See more cancelled gigs →') }}
                    </a>
                </div>
            @endif
        @else
            <div class="alert alert-error shadow-sm mt-3">
                <span>{{ __('No cancelled jobs found.') }}</span>
            </div>
        @endif
    </div>

    {{-- Section: Completed Jobs --}}
    <div>
        <h2
            class="text-xl font-semibold mb-4 flex items-center gap-2 text-success">
            <i class="fa-solid fa-check-circle"></i>
            {{ __('Completed Jobs') }}
        </h2>

        @php $completedJobs = $jobs->where('status', 'completed')->sortByDesc('created_at')->take(3); @endphp

        @if ($completedJobs->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($completedJobs as $job)
                    <x-client.job-card :job="$job" />
                @endforeach
            </div>

            @if ($jobs->where('status', 'completed')->count() > 3)
                <div class="mt-4 text-right">
                    <a href="{{ route('client.jobs.completed') }}"
                        class="link link-success">
                        {{ __('See more completed gigs →') }}
                    </a>
                </div>
            @endif
        @else
            <div class="alert alert-success shadow-sm mt-3">
                <span>{{ __('No completed jobs found.') }}</span>
            </div>
        @endif
    </div>
</x-layouts.app>
