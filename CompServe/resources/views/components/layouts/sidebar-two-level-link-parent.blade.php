@props(['active' => false, 'title' => '', 'icon' => 'fas-list'])

<li x-data="{ open: {{ $active ? 'true' : 'false' }} }"
    class="w-full">
    <button
        @click="
            if (sidebarOpen) {
                open = !open;
            } else {
                temporarilyOpenSidebar();
                open = true;
            }
        "
        @class([
            'flex items-center justify-between gap-3 px-4 py-2 rounded-lg transition-all duration-200 w-full',
            'text-base-content hover:bg-base-200 dark:hover:bg-base-300',
            // Active state
            'bg-primary text-primary-content font-semibold shadow-sm' => $active,
        ])>
        <div class="flex items-center gap-3">
            @svg($icon, $active ? 'w-5 h-5 text-primary-content' : 'w-5 h-5 text-base-content/70')
            <span
                :class="{ 'opacity-0 hidden ml-0': !sidebarOpen, 'ml-1': sidebarOpen }"
                class="transition-all duration-300 ease-in-out whitespace-nowrap">
                {{ $title }}
            </span>
        </div>

        {{-- Dropdown arrow --}}
        <svg xmlns="http://www.w3.org/2000/svg"
            class="h-4 w-4 transition-transform duration-200"
            :class="{ 'rotate-90': open, 'opacity-0': !sidebarOpen }"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 5l7 7-7 7" />
        </svg>
    </button>

    <!-- Level 2 submenu -->
    <div x-show="open && sidebarOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        {{-- class="mt-1 ml-4 space-y-1" --}}
        class="mt-1"
        >
        <ul class="menu bg-base-200 rounded-lg p-2 shadow-inner w-full">
            {{ $slot }}
        </ul>
    </div>
</li>
