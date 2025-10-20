@props(['active' => false, 'href' => '#', 'icon' => null])

<li>
    <a href="{{ $href }}"
        @class([
            // Base styles from daisyUI's `menu` + some custom spacing
            'flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-200',
            'text-base-content hover:bg-base-200 dark:hover:bg-base-300',
            // Active state
            'bg-primary text-primary-content font-semibold shadow-sm' => $active,
        ])>

        {{-- Icon --}}
        @svg($icon, $active ? 'w-5 h-5 text-primary-content' : 'w-5 h-5 text-base-content/70')

        {{-- Label --}}
        <span :class="{ 'hidden ml-0': !sidebarOpen, 'ml-1': sidebarOpen }"
            x-transition:enter="transition-opacity duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="whitespace-nowrap">
            {{ $slot }}
        </span>
    </a>
</li>
