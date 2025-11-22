@props(['cert'])

<div
    class="card bg-base-200 border border-base-300 shadow-sm hover:shadow-md transition">
    <div class="card-body space-y-4">

        {{-- Header --}}
        <div class="flex justify-between items-start">
            <h2 class="card-title text-lg font-semibold leading-tight">
                {{ Str::limit($cert->type, 40) }}
            </h2>

            {{-- Status Badge --}}
            <div
                class="badge badge-outline p-2 text-xs
                @if ($cert->status === 'pending') badge-accent
                @elseif($cert->status === 'approved') badge-success
                @elseif($cert->status === 'rejected') badge-error @endif">
                {{ ucfirst($cert->status) }}
            </div>
        </div>

        {{-- Description --}}
        <p class="text-sm text-base-content/70">
            {{ Str::limit($cert->description ?? 'No description provided.', 80) }}
        </p>

        {{-- Certification Details --}}
        <div class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">

            <p><span class="font-medium">Type:</span>
                {{ $cert->type }}
            </p>

            <p><span class="font-medium">Uploaded:</span>
                {{ $cert->created_at->format('M d, Y') }}
            </p>

            <p class="col-span-2">
                <span class="font-medium">Document:</span>
                {{ basename($cert->document_path) }}
            </p>
        </div>

        {{-- Footer --}}
        <div class="flex justify-between items-center pt-2">

            <p class="text-xs text-base-content/60">
                Submitted {{ $cert->created_at->diffForHumans() }}
            </p>

            <a href="{{ Storage::url($cert->document_path) }}"
                target="_blank"
                class="btn btn-sm btn-secondary">
                View
            </a>
        </div>

    </div>
</div>
