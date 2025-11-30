@props(['cert'])

@php
    // Map some common certification types to emojis
    $typeEmojis = [
        'NC I' => '🟢',
        'NC II' => '🔵',
        'NC III' => '🟡',
        'NC IV' => '🟠',
        'CompTIA A+' => '💻',
        'CompTIA Network+' => '🌐',
        'CompTIA Security+' => '🛡️',
        'Cisco CCNA' => '🖧',
        'Cisco CCNP' => '🖧',
        'Microsoft Azure Fundamentals' => '☁️',
        'AWS Certified Cloud Practitioner' => '☁️',
        'Google Data Analytics' => '📊',
        'PMP' => '📈',
        'Scrum Master' => '⚡',
    ];

    $emoji = $typeEmojis[$cert->type] ?? '📄'; // default icon
@endphp

<div
    class="card bg-base-100 border border-base-300 shadow-md hover:shadow-lg transition duration-300 rounded-xl overflow-hidden">

    {{-- Card Body --}}
    <div class="card-body space-y-4">

        {{-- Header --}}
        <div class="flex justify-between items-start">
            <h2
                class="card-title text-lg font-bold text-primary truncate flex items-center gap-2">
                <span>{{ $emoji }}</span>
                <span>{{ Str::limit($cert->type, 50) }}</span>
            </h2>

            {{-- Status Badge --}}
            <span
                class="badge badge-outline p-2 text-xs
                @if ($cert->status === 'pending') badge-warning
                @elseif($cert->status === 'approved') badge-success
                @elseif($cert->status === 'rejected') badge-error @endif">
                {{ match ($cert->status) {
                    'approved' => '🟢 Approved',
                    'pending' => '⏳ Pending',
                    'rejected' => '❌ Rejected',
                    default => ucfirst(str_replace('_', ' ', $job->status)),
                } }}
            </span>
        </div>

        {{-- Description --}}
        <p class="text-sm text-base-content/70">
            {{ Str::limit($cert->description ?? 'No description provided.', 100) }}
        </p>

        {{-- Certification Details --}}
        <div class="grid grid-cols-2 gap-3 text-sm">
            <p><span class="font-medium">Type:</span> {{ $cert->type }}</p>
            <p><span class="font-medium">Uploaded:</span>
                {{ $cert->created_at->format('M d, Y') }}</p>
            <p class="col-span-2"><span class="font-medium">Document:</span>
                {{ basename($cert->document_path) }}</p>
        </div>

        {{-- Footer / Actions --}}
        <div
            class="flex justify-between items-center pt-3 border-t border-base-200">
            <p class="text-xs text-base-content/60">
                Submitted {{ $cert->created_at->diffForHumans() }}
            </p>

            <div class="flex gap-2">

                {{-- View Button --}}
                <a href="{{ Storage::url($cert->document_path) }}"
                    target="_blank"
                    class="btn btn-sm btn-outline btn-primary hover:btn-primary">
                    👁️ View
                </a>

                {{-- Delete Button --}}
                <button class="btn btn-sm btn-error btn-outline"
                    onclick="document.getElementById('delete_cert_modal_{{ $cert->id }}').showModal()">
                    ❌ Delete
                </button>

            </div>
        </div>

    </div>
</div>

{{-- Delete Confirmation Modal --}}
<dialog id="delete_cert_modal_{{ $cert->id }}"
    class="modal">
    <form method="POST"
        action="{{ route('certifications.destroy', $cert) }}"
        class="modal-box space-y-4">
        @csrf
        @method('DELETE')
        <h3 class="font-bold text-lg text-red-600">❌ Delete Certification?</h3>
        <p>Are you sure you want to delete this certification? This action
            cannot be undone.</p>

        <div class="modal-action justify-end gap-2">
            <button type="submit"
                class="btn btn-error">Yes, Delete</button>
            <button type="button"
                class="btn"
                onclick="document.getElementById('delete_cert_modal_{{ $cert->id }}').close()">Cancel</button>
        </div>
    </form>
</dialog>
