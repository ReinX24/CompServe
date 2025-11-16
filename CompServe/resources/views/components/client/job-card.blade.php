@props(['job'])

<div
    class="card bg-base-200 border border-base-300 shadow-sm hover:shadow-md transition">
    <div class="card-body space-y-4">

        {{-- Header --}}
        <div class="flex justify-between items-start">
            <h2 class="card-title text-lg font-semibold leading-tight">
                <a href="{{ route('client.jobs.show', $job->id) }}"
                    class="link link-hover text-primary">
                    {{ Str::limit($job->title, 40) }}
                </a>
            </h2>

            {{-- Status Badge --}}
            <div
                class="badge badge-outline p-2 text-xs
                @if ($job->status === 'open') badge-accent
                @elseif($job->status === 'in_progress') badge-secondary
                @elseif($job->status === 'cancelled') badge-error
                @elseif($job->status === 'completed') badge-success @endif">
                {{ ucfirst(str_replace('_', ' ', $job->status)) }}
            </div>
        </div>

        {{-- Short Description --}}
        <p class="text-sm text-base-content/70">
            {{ Str::limit($job->description, 80) }}
        </p>

        {{-- Concise Job Details --}}
        <div class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
            <p><span class="font-medium">Budget:</span>
                ${{ number_format($job->budget, 2) }}</p>
            <p><span class="font-medium">Type:</span>
                {{ ucfirst($job->duration_type) }}</p>
            <p><span class="font-medium">Category:</span> {{ $job->category }}
            </p>
            <p><span class="font-medium">Applicants:</span>
                {{ $job->applicants->count() }}</p>
            <p><span class="font-medium">Duration:</span> {{ $job->duration }}
            </p>
            <p class="col-span-2"><span class="font-medium">Location:</span>
                {{ $job->location ?? 'Remote' }}</p>
        </div>

        {{-- Footer --}}
        <div class="flex justify-between items-center pt-2">
            <p class="text-xs text-base-content/60">
                Posted {{ $job->created_at->diffForHumans() }}
            </p>
            <a href="{{ route('client.jobs.show', $job->id) }}"
                class="btn btn-sm btn-secondary">
                View
            </a>
        </div>

    </div>
</div>
