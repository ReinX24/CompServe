<x-layouts.app>
    <div class="breadcrumbs text-sm mb-4">
        <ul class="text-base-content/70">
            <li><a href="{{ route('dashboard') }}"
                    class="hover:text-primary">Dashboard</a></li>
            <li class="text-primary font-semibold">Open Gigs</li>
        </ul>
    </div>

    @if (Auth::user()->role === 'client')
        <x-client.page-header-with-action title=" Gigs"
            description="All available open gigs."
            buttonText="Add Gig"
            :buttonLink="route('client.jobs.create') . '?type=gig'" />
    @elseif(Auth::user()->role === 'freelancer')
        <x-client.page-header-with-action title="Open Gigs"
            description="All available open gigs." />
    @endif

    @if (Auth::user()->role === 'client')
        <x-client.job-search-form :route="route('client.gigs.open')" />
    @elseif(Auth::user()->role === 'freelancer')
        <x-client.job-search-form :route="route('freelancer.gigs.open')" />
    @endif

    @if ($jobs->count())
        <div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($jobs as $job)
                    <x-client.job-card :job="$job" />
                @endforeach
            </div>

            <div class="mt-4">
                {{ $jobs->withQueryString()->links() }}
            </div>
        </div>
    @else
        <p class="text-gray-700 dark:text-gray-300">
            @if (Auth::user()->role === 'client')
                {{ __('You have not posted any gigs yet.') }}
            @elseif(Auth::user()->role === 'freelancer')
                {{ __('No gigs found.') }}
            @endif
        </p>
    @endif
</x-layouts.app>
