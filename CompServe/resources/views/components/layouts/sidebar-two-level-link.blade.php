@props(['active' => false, 'href' => '#', 'icon' => 'fas-house'])

<a href="{{ $href }}"
    @class([
        // Base styles (consistent with DaisyUI menu links)
        'flex items-center gap-3 px-4 py-2 text-sm rounded-lg transition-all duration-200',
        'text-base-content hover:bg-base-200 dark:hover:bg-base-300',

        // Active state
        'bg-primary text-primary-content font-semibold shadow-sm' => $active,
    ])>
    <div class="flex items-center gap-3">
        {{-- Icon --}}
        @svg($icon, $active ? 'w-5 h-5 text-primary-content' : 'w-5 h-5 text-base-content/70')

        {{-- Label --}}
        <span
            :class="{ 'opacity-0 hidden ml-0': !sidebarOpen, 'ml-1': sidebarOpen }"
            class="transition-all duration-300 ease-in-out whitespace-nowrap">
            {{ $slot }}
        </span>
    </div>
</a>
