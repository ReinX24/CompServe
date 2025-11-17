<x-layouts.app>
    <div class="breadcrumbs text-sm mb-4">
        <ul class="text-base-content/70">
            <li><a href="{{ route('dashboard') }}"
                    class="hover:text-primary">Dashboard</a></li>
            <li class="text-primary font-semibold">Rejected Gigs</li>
        </ul>
    </div>

    <x-client.page-header-with-action title="Rejected Gigs"
        description="All gigs you were rejected from." />

    @if (Auth::user()->role === 'client')
        <x-client.job-search-form :route="route('client.gigs.rejected')" />
    @elseif(Auth::user()->role === 'freelancer')
        <x-client.job-search-form :route="route('freelancer.gigs.rejected')" />
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
            {{ __('You have not posted any jobs yet.') }}
        </p>
    @endif
</x-layouts.app>
