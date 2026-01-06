@props(['cert'])

@php
    // Map certification types to emojis and colors
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

    $emoji = $typeEmojis[$cert->type] ?? '📄';

    // Status configurations
    $statusConfig = [
        'approved' => [
            'badge' => 'badge-success',
            'text' => '✓ Approved',
            'border' => 'border-success/30',
            'gradient' => 'from-success/5 to-success/10',
            'icon_bg' => 'bg-success/10',
            'icon_color' => 'text-success',
        ],
        'pending' => [
            'badge' => 'badge-warning',
            'text' => '⏳ Pending Review',
            'border' => 'border-warning/30',
            'gradient' => 'from-warning/5 to-warning/10',
            'icon_bg' => 'bg-warning/10',
            'icon_color' => 'text-warning',
        ],
        'rejected' => [
            'badge' => 'badge-error',
            'text' => '✕ Rejected',
            'border' => 'border-error/30',
            'gradient' => 'from-error/5 to-error/10',
            'icon_bg' => 'bg-error/10',
            'icon_color' => 'text-error',
        ],
        'expired' => [
            'badge' => 'badge-neutral',
            'text' => '⌛ Expired',
            'border' => 'border-neutral/30',
            'gradient' => 'from-neutral/5 to-neutral/10',
            'icon_bg' => 'bg-neutral/10',
            'icon_color' => 'text-neutral',
        ],
    ];

    $config = $statusConfig[$cert->status] ?? $statusConfig['pending'];
@endphp

<div class="group relative">
    <!-- Glowing Effect on Hover -->
    <div
        class="absolute -inset-0.5 bg-linear-to-r {{ $config['gradient'] }} rounded-2xl opacity-0 group-hover:opacity-100 transition duration-500 blur">
    </div>

    <!-- Main Card -->
    <div
        class="relative bg-base-100 border-2 {{ $config['border'] }} shadow-lg hover:shadow-2xl transition-all duration-300 rounded-2xl overflow-hidden group-hover:scale-[1.02]">

        <!-- Status Ribbon (Top Right Corner) -->
        <div class="absolute top-0 right-0 z-10">
            <div class="relative">
                <div
                    class="absolute inset-0 bg-linear-to-br {{ $config['gradient'] }} blur-sm">
                </div>
                <span
                    class="relative badge {{ $config['badge'] }} badge-lg gap-1 rounded-bl-xl rounded-tr-2xl px-4 py-3 font-semibold shadow-lg border-0">
                    {{ $config['text'] }}
                </span>
            </div>
        </div>

        <!-- Decorative Top Border -->
        <div class="h-2 bg-linear-to-r {{ $config['gradient'] }}"></div>

        {{-- Card Body --}}
        <div class="card-body p-6 space-y-5">

            {{-- Header with Icon --}}
            <div class="flex items-start gap-4 pt-8">
                <!-- Large Emoji Icon -->
                <div class="shrink-0">
                    <div
                        class="{{ $config['icon_bg'] }} p-4 rounded-2xl shadow-inner group-hover:scale-110 transition-transform duration-300">
                        <span class="text-4xl">{{ $emoji }}</span>
                    </div>
                </div>

                <!-- Title -->
                <div class="flex-1 min-w-0">
                    <h2
                        class="text-xl font-bold text-base-content line-clamp-2 mb-1 group-hover:text-primary transition-colors duration-200">
                        {{ $cert->type }}
                    </h2>
                    <div
                        class="flex items-center gap-2 text-xs text-base-content/50">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-3.5 w-3.5"
                            viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $cert->created_at->format('M d, Y') }}
                    </div>
                </div>
            </div>

            {{-- Description --}}
            <div
                class="bg-base-200/50 rounded-xl p-4 border border-base-300/50">
                <p class="text-sm text-base-content/80 leading-relaxed">
                    {{ Str::limit($cert->description ?? 'No description provided.', 120) }}
                </p>
            </div>

            {{-- Certification Details --}}
            <div class="space-y-3">
                <!-- Info Grid -->
                <div class="grid grid-cols-2 gap-3">
                    <!-- Document Info -->
                    <div
                        class="col-span-2 flex items-start gap-3 bg-base-200/30 rounded-lg p-3 border border-base-300/50">
                        <div class="shrink-0 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-primary"
                                viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p
                                class="text-xs text-base-content/60 mb-1 font-medium">
                                Document</p>
                            <p
                                class="text-sm text-base-content font-medium truncate">
                                {{ basename($cert->document_path) }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Time Indicator -->
                <div
                    class="flex items-center gap-2 text-xs text-base-content/50 pt-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Submitted
                        {{ $cert->created_at->diffForHumans() }}</span>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex gap-3 pt-4 border-t border-base-300/50">
                {{-- View Button --}}
                <a href="{{ Storage::url($cert->document_path) }}"
                    target="_blank"
                    class="flex-1 btn btn-primary btn-sm gap-2 group/btn hover:gap-3 transition-all duration-300 shadow-md hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd"
                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">View</span>
                </a>

                {{-- Delete Button --}}
                <button
                    class="btn btn-error btn-outline btn-sm gap-2 hover:gap-3 transition-all duration-300 shadow-md hover:shadow-lg group/btn"
                    onclick="document.getElementById('delete_cert_modal_{{ $cert->id }}').showModal()">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 group-hover/btn:rotate-12 transition-transform duration-300"
                        viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">Delete</span>
                </button>
            </div>

        </div>
    </div>
</div>

{{-- Enhanced Delete Confirmation Modal --}}
<dialog id="delete_cert_modal_{{ $cert->id }}"
    class="modal modal-bottom sm:modal-middle">
    <div class="modal-box relative overflow-hidden">
        <!-- Decorative Background -->
        <div
            class="absolute top-0 right-0 w-40 h-40 bg-error/5 rounded-full blur-3xl">
        </div>

        <form method="POST"
            action="{{ route('certifications.destroy', $cert) }}"
            class="relative space-y-6">
            @csrf
            @method('DELETE')

            <!-- Icon -->
            <div class="flex justify-center">
                <div class="bg-error/10 p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-12 w-12 text-error"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>

            <!-- Title & Message -->
            <div class="text-center space-y-2">
                <h3 class="font-bold text-2xl text-error">Delete Certification?
                </h3>
                <p class="text-base-content/70 px-4">
                    Are you sure you want to delete <span
                        class="font-semibold text-base-content">"{{ Str::limit($cert->type, 40) }}"</span>?
                    This action cannot be undone.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 justify-center pt-2">
                <button type="button"
                    class="btn btn-ghost gap-2"
                    onclick="document.getElementById('delete_cert_modal_{{ $cert->id }}').close()">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Cancel
                </button>
                <button type="submit"
                    class="btn btn-error gap-2 shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Yes, Delete
                </button>
            </div>
        </form>
    </div>
    <form method="dialog"
        class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
