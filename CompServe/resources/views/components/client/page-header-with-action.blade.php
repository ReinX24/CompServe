@props([
    'title' => '',
    'description' => '',
    'buttonText' => '',
    'buttonLink' => '#',
    'icon' => null,
    'emoji' => null, // Optional: pass emoji like '💼' or '🎓'
    'stats' => [], // Optional: array of stats like ['label' => 'Total', 'value' => '10', 'color' => 'primary']
])

<!-- Hero Header with Gradient Background -->
<div
    class="relative overflow-hidden bg-linear-to-br from-primary/10 via-secondary/5 to-accent/10 rounded-2xl shadow-xl mb-8 border border-base-300/50">
    <!-- Decorative Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div
            class="absolute top-0 left-0 w-40 h-40 bg-primary rounded-full blur-3xl">
        </div>
        <div
            class="absolute bottom-0 right-0 w-60 h-60 bg-secondary rounded-full blur-3xl">
        </div>
    </div>

    <div class="relative p-8 md:p-10">
        <div
            class="flex flex-col md:flex-row md:justify-between md:items-center gap-6">
            <div class="flex-1">
                <!-- Title with Icon/Emoji -->
                <h1
                    class="text-4xl md:text-5xl font-bold text-base-content mb-3 flex items-center gap-3 flex-wrap">
                    @if ($emoji)
                        <span class="text-5xl">{{ $emoji }}</span>
                    @elseif ($icon)
                        <div
                            class="p-3 bg-linear-to-br from-primary to-primary/70 rounded-2xl shadow-lg shrink-0">
                            {{ $icon }}
                        </div>
                    @endif
                    <span>{{ $title }}</span>
                </h1>

                <!-- Description -->
                <p class="text-base md:text-lg text-base-content/70 max-w-2xl">
                    {{ $description }}
                </p>

                <!-- Stats Section (if provided) -->
                @if (!empty($stats))
                    <div class="flex flex-wrap gap-6 mt-6">
                        @foreach ($stats as $stat)
                            @php
                                $statColor = $stat['color'] ?? 'primary';
                                $statIcon = $stat['icon'] ?? null;
                            @endphp
                            <div class="flex items-center gap-2">
                                <div
                                    class="bg-{{ $statColor }}/20 text-{{ $statColor }} p-2 rounded-lg">
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
                                        class="text-2xl font-bold text-base-content">
                                        {{ $stat['value'] }}</p>
                                    <p class="text-xs text-base-content/60">
                                        {{ $stat['label'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Action Button (Only for Clients) -->
            @if (Auth::user()->role === 'client' && $buttonText)
                <div class="shrink-0">
                    <a href="{{ $buttonLink }}"
                        class="btn btn-primary btn-lg shadow-2xl hover:shadow-primary/50 hover:scale-105 transition-all duration-300 gap-2 group">
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

<!-- Add Custom Animations -->
<style>
    @keyframes ping {

        75%,
        100% {
            transform: scale(2);
            opacity: 0;
        }
    }

    .animate-ping {
        animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
    }
</style>
