@php
    $selectedStatus = request('status');
    $statuses = [
        'open' => [
            'title' => __('Open Gigs'),
            'icon' => 'fa-briefcase',
            'color' => 'text-primary',
        ],
        'in_progress' => [
            'title' => __('In Progress Gigs'),
            'icon' => 'fa-spinner animate-spin-slow',
            'color' => 'text-secondary',
        ],
        'cancelled' => [
            'title' => __('Cancelled Jobs'),
            'icon' => 'fa-ban',
            'color' => 'text-error',
        ],
        'completed' => [
            'title' => __('Completed Jobs'),
            'icon' => 'fa-check-circle',
            'color' => 'text-success',
        ],
    ];
@endphp

<x-layouts.app>
    <div class="breadcrumbs text-sm mb-4">
        <ul class="text-base-content/70">
            <li><a href="{{ route('dashboard') }}"
                    class="hover:text-primary">Dashboard</a></li>
            <li class="text-primary font-semibold">All Gigs</li>
        </ul>
    </div>

    <x-client.page-header-with-action title="All Gigs"
        description="Gigs are short term jobs that last a week up to a month."
        buttonText="Add Gig"
        :buttonLink="route('client.jobs.create') . '?type=gig'" />

    <x-client.job-search-form :route="route('client.gigs.index')" />

    @foreach ($statuses as $status => $info)
        @if (!$selectedStatus || $selectedStatus === $status)
            @php
                $jobsByStatus = $jobs
                    ->where('status', $status)
                    ->sortByDesc('created_at')
                    ->take(3);
            @endphp

            <div class="mb-10">
                <h2
                    class="text-xl font-semibold mb-4 flex items-center gap-2 {{ $info['color'] }}">
                    <i class="fa-solid {{ $info['icon'] }}"></i>
                    {{ $info['title'] }}
                </h2>

                @if ($jobsByStatus->count())
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($jobsByStatus as $job)
                            <x-client.job-card :job="$job" />
                        @endforeach
                    </div>

                    @if ($jobs->where('status', $status)->count() > 3)
                        <div class="mt-4 text-right">
                            <a href="{{ route('client.gigs.' . $status) }}"
                                class="link {{ $info['color'] }}">
                                {{ __('See more ' . strtolower($info['title']) . ' →') }}
                            </a>
                        </div>
                    @endif
                @else
                    <div class="alert alert-info shadow-sm mt-3">
                        <span>{{ __('No ' . strtolower($info['title']) . ' found.') }}</span>
                    </div>
                @endif
            </div>
        @endif
    @endforeach
</x-layouts.app>
