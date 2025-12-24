@props([
    'avatar' => null,
    'name' => 'John Doe',
    'role' => 'Client',
    'rating' => 5,
    'review' => 'This freelancer did an amazing job! Highly recommended.',
    'date' => '2025-01-01',
    'verified' => false,
    'reviewjob' => null
])

<div
    class="card bg-base-100 border-2 border-base-200 shadow-sm hover:shadow-md hover:border-primary-content transition-all duration-300 overflow-hidden group">
    <div class="card-body p-6 space-y-4">

        {{-- Header Section --}}
        <div class="flex justify-between items-start gap-3">
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-3">
                    {{-- Avatar --}}
                    <div class="avatar placeholder">
                        @if ($avatar)
                            <div
                                class="w-12 h-12 rounded-full ring-2 ring-primary/20">
                                <img src="{{ $avatar }}"
                                    alt="{{ $name }} Avatar"
                                    class="object-cover">
                            </div>
                        @else
                            <div
                                class="bg-primary/10 text-primary rounded-full w-12 h-12 flex items-center justify-center text-sm font-bold">
                                {{ strtoupper(substr($name, 0, 2)) }}
                            </div>
                        @endif
                    </div>

                    {{-- Name & Role --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="text-lg font-bold text-base-content">
                                {{ $name }}</h3>
                            @if ($verified)
                                <div class="badge badge-primary badge-sm gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-3 w-3"
                                        viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Verified
                                </div>
                            @endif
                        </div>
                        <span
                            class="text-sm text-base-content/70">{{ $role }}</span>
                    </div>
                </div>
            </div>

            {{-- Rating Badge --}}
            <div
                class="badge badge-lg badge-outline badge-warning gap-2 font-semibold shadow-sm">
                <span class="text-base">⭐</span>
                <span class="hidden sm:inline">{{ $rating }}.0</span>
            </div>
        </div>

        {{-- Star Rating Display --}}
        <div class="flex items-center gap-2">
            <div class="flex gap-0.5">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $rating)
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5 fill-warning stroke-warning">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5 stroke-base-content/40">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>
                    @endif
                @endfor
            </div>
            <span
                class="text-sm font-semibold text-base-content/80">{{ $rating }}.0
                out of 5</span>
        </div>

        {{-- Review Content --}}
        <div class="bg-base-200/50 rounded-lg p-4">
            <p class="text-sm text-base-content/70 leading-relaxed">
                {{ $review }}
            </p>
        </div>

        <div class="bg-base-200/50 rounded-lg p-4">
            <p class="text-sm text-base-content/70 leading-relaxed">
                {{ $reviewjob->title }}
            </p>
        </div>

        {{-- Footer --}}
        <div
            class="flex justify-between items-center pt-2 border-t border-base-200">
            <div class="flex items-center gap-2 text-xs text-base-content/60">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>{{ \Carbon\Carbon::parse($date)->diffForHumans() }}</span>
            </div>
        </div>

    </div>
</div>
