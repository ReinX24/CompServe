@props([
    'title' => '',
    'description' => '',
    'buttonText' => '',
    'buttonLink' => '#',
    'icon' => null,
    'emoji' => null,
    'stats' => [],
])

<!-- Hero Header with Gradient Background (CompBot Style) -->
<div class="mb-8">
    <div
        class="relative overflow-hidden rounded-3xl bg-linear-to-r from-blue-500 via-purple-500 to-blue-600 p-8 shadow-2xl">
        <!-- Animated Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div
                class="absolute top-0 left-0 w-40 h-40 bg-white rounded-full -translate-x-1/2 -translate-y-1/2">
            </div>
            <div
                class="absolute bottom-0 right-0 w-32 h-32 bg-white rounded-full translate-x-1/2 translate-y-1/2">
            </div>
            <div
                class="absolute top-1/2 left-1/2 w-24 h-24 bg-white rounded-full -translate-x-1/2 -translate-y-1/2">
            </div>
        </div>

        <div class="relative">
            <div
                class="flex flex-col md:flex-row md:justify-between md:items-center gap-6">
                <div class="flex items-start gap-6 flex-1">
                    <!-- Icon/Emoji Avatar -->
                    @if ($emoji || $icon)
                        <div class="relative shrink-0">
                            <div
                                class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-white/30 shadow-lg transform hover:scale-110 transition-transform">
                                @if ($emoji)
                                    <span
                                        class="text-5xl animate-bounce">{{ $emoji }}</span>
                                @else
                                    <div class="text-white scale-150">
                                        {{ $icon }}
                                    </div>
                                @endif
                            </div>
                            <!-- Online Status Indicator -->
                            <div
                                class="absolute -bottom-2 -right-2 w-6 h-6 bg-green-400 rounded-full border-3 border-white animate-pulse">
                            </div>
                        </div>
                    @endif

                    <!-- Title and Description -->
                    <div class="flex-1">
                        <h1
                            class="text-4xl font-extrabold tracking-tight text-white mb-2">
                            {{ $title }}
                        </h1>

                        <p
                            class="text-lg text-blue-100 flex items-center gap-2 flex-wrap">
                            <svg class="w-5 h-5 shrink-0"
                                fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ $description }}</span>
                        </p>

                        <!-- Stats Section (if provided) -->
                        @if (!empty($stats))
                            <div class="flex flex-wrap gap-6 mt-6">
                                @foreach ($stats as $stat)
                                    @php
                                        $statIcon = $stat['icon'] ?? null;
                                    @endphp
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="bg-white/20 backdrop-blur-sm text-white p-2.5 rounded-xl border border-white/30">
                                            @if ($statIcon)
                                                {{ $statIcon }}
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <p
                                                class="text-2xl font-bold text-white">
                                                {{ $stat['value'] }}
                                            </p>
                                            <p class="text-xs text-blue-100">
                                                {{ $stat['label'] }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action Button (Only for Clients) -->
                @if (Auth::user()->role === 'client' && $buttonText)
                    <div class="shrink-0">
                        <a href="{{ $buttonLink }}"
                            class="btn bg-white hover:bg-blue-50 text-blue-600 border-0 btn-lg shadow-2xl hover:shadow-white/50 hover:scale-105 transition-all duration-300 gap-2 group">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 group-hover:rotate-90 transition-transform duration-300"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            {{ $buttonText }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Custom Animations -->
<style>
    @keyframes bounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    .animate-bounce {
        animation: bounce 2s ease-in-out infinite;
    }

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
</style>
