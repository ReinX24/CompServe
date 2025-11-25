<x-layouts.app>
    <div class="breadcrumbs text-sm mb-4">
        <ul class="text-base-content/70">
            <li><a href="{{ route('dashboard') }}"
                    class="hover:text-primary">Dashboard</a></li>
            <li class="text-primary font-semibold">Open Contracts</li>
        </ul>
    </div>

    @if (Auth::user()->role === 'client')
        <x-client.page-header-with-action title="Open Contracts"
            description="All your open contracts."
            buttonText="Add Contract"
            :buttonLink="route('client.jobs.create') . '?type=contract'" />
    @elseif(Auth::user()->role === 'freelancer')
        <x-client.page-header-with-action title="Open Contracts"
            description="All your open contracts." />
    @endif

    @if (Auth::user()->role === 'client')
        <x-client.job-search-form :route="route('client.contracts.open')" />
    @elseif(Auth::user()->role === 'freelancer')
        <x-client.job-search-form :route="route('freelancer.contracts.open')" />
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
                {{ __('You have not posted any contracts yet.') }}
            @elseif(Auth::user()->role === 'freelancer')
                {{ __('No contracts found.') }}
            @endif
        </p>
    @endif
</x-layouts.app>
