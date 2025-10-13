<aside x-show="sidebarOpen"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="-translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="-translate-x-full opacity-0"
    class="fixed inset-y-0 left-0 z-30 w-64 bg-sidebar text-sidebar-foreground border-r border-gray-200 dark:border-gray-700 shadow-lg pt-16">

    <!-- Sidebar Content -->
    <div class="h-full flex flex-col">
        <!-- Sidebar Menu -->
        <nav class="flex-1 overflow-y-auto custom-scrollbar py-4">
            <ul class="space-y-1 px-2">
                {{-- Freelancer --}}
                @if (Auth::user()->role === 'freelancer')
                    <x-layouts.freelancer-sidebar />
                @elseif (Auth::user()->role === 'client')
                    <x-layouts.client-sidebar />
                @elseif (Auth::user()->role === 'admin')
                    <x-layouts.admin-sidebar />
                @endif
            </ul>
        </nav>
    </div>
</aside>

<!-- Backdrop overlay -->
<div x-show="sidebarOpen"
    @click="toggleSidebar"
    x-transition.opacity
    class="fixed inset-0 bg-black/30 z-20 lg:hidden"></div>
