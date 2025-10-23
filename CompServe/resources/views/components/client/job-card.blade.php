@props(['job'])

<div
    class="card bg-base-100 dark:bg-base-200 border border-base-300 shadow-md hover:shadow-lg transition duration-300">
    <div class="card-body space-y-3">

        {{-- Header --}}
        <div class="flex justify-between items-start">
            <h2 class="card-title text-lg font-bold text-base-content">
                <a href="{{ route('client.jobs.show', $job->id) }}"
                    class="link link-hover text-primary">
                    {{ Str::limit($job->title, 40) }}
                </a>
            </h2>

            {{-- Status Badge --}}
            @if ($job->status === 'open')
                <div class="badge badge-accent badge-outline p-3 text-sm">Open
                </div>
            @elseif($job->status === 'in_progress')
                <div class="badge badge-warning badge-outline p-3 text-sm">
                    In-progress</div>
            @elseif($job->status === 'cancelled')
                <div class="badge badge-error badge-outline p-3 text-sm">
                    Cancelled</div>
            @elseif($job->status === 'completed')
                <div class="badge badge-success badge-outline p-3 text-sm">
                    Completed</div>
            @endif
        </div>

        {{-- Description --}}
        <p class="text-sm text-base-content/70 leading-snug">
            {{ Str::limit($job->description, 100) }}
        </p>

        {{-- Job Details --}}
        <div class="grid grid-cols-1 gap-1 text-sm text-base-content/80">
            <p><span class="font-medium">{{ __('Budget:') }}</span>
                ${{ number_format($job->budget, 2) }}</p>
            <p><span class="font-medium">{{ __('Location:') }}</span>
                {{ $job->location ?? 'Remote' }}</p>
            <p><span class="font-medium">{{ __('Category:') }}</span>
                {{ $job->category }}</p>
            <p><span class="font-medium">{{ __('Type:') }}</span>
                {{ ucfirst($job->duration_type) }}</p>
            <p><span class="font-medium">{{ __('Client:') }}</span>
                {{ $job->client->name }}</p>
        </div>

        {{-- Posted Date --}}
        <p class="text-xs text-base-content/60">
            {{ __('Posted on') }} {{ $job->created_at->format('M d, Y') }}
        </p>

        {{-- Action --}}
        <div class="card-actions mt-3">
            <a href="{{ route('client.jobs.show', $job->id) }}"
                class="btn btn-primary btn-sm">
                {{ __('View Details') }}
            </a>
        </div>
    </div>
</div>
