<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <meta name="csrf-token"
        content="{{ csrf_token() }}">
    <script>
        const htmlTag = document.documentElement;

        function applyTheme(mode) {
            if (mode === 'dark') {
                htmlTag.classList.add('dark');
                htmlTag.setAttribute('data-theme', 'dark');
            } else {
                htmlTag.classList.remove('dark');
                htmlTag.setAttribute('data-theme', 'light');
            }
        }

        function setAppearance(mode) {
            if (mode === 'system') {
                localStorage.removeItem('appearance');
                const prefersDark = window.matchMedia(
                    '(prefers-color-scheme: dark)').matches;
                applyTheme(prefersDark ? 'dark' : 'light');
            } else {
                localStorage.setItem('appearance', mode);
                applyTheme(mode);
            }
        }

        // Load saved theme or fallback to system
        const saved = localStorage.getItem('appearance');
        if (saved) {
            applyTheme(saved);
        } else {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)')
                .matches;
            applyTheme(prefersDark ? 'dark' : 'light');
        }

        window.setAppearance = setAppearance;

        // This is for presence.js, which shows if the user is online or not
        window.authId = {{ auth()->id() }};
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- For showing if the current user is online --}}
    @vite(['resources/js/presence.js'])
</head>

<body
    class="antialiased bg-linear-to-br from-primary/10 via-base-100 to-secondary/10"
    x-data="{
        sidebarOpen: localStorage.getItem('sidebarOpen') === null ? window.innerWidth >= 1024 : localStorage.getItem('sidebarOpen') === 'true',
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
            localStorage.setItem('sidebarOpen', this.sidebarOpen);
        },
        temporarilyOpenSidebar() {
            if (!this.sidebarOpen) {
                this.sidebarOpen = true;
                localStorage.setItem('sidebarOpen', true);
            }
        },
        formSubmitted: false,
    }">

    <!-- Main Container -->
    <div class="min-h-screen flex flex-col">

        <x-layouts.app.header />

        <!-- Main Content Area -->
        <div class="flex flex-1 overflow-hidden">

            <x-layouts.app.sidebar />

            <!-- Main Content -->
            <main
                :class="{
                    'lg:ml-64': sidebarOpen, // shift when sidebar is open on desktop
                    'lg:ml-0': !
                        sidebarOpen // collapsed (if you add a mini mode later)
                }"
                class="flex-1 overflow-auto content-transition pt-20">
                <div class="p-6">
                    <!-- Success Message -->
                    @session('status')
                        <div x-data="{ showStatusMessage: true }"
                            x-show="showStatusMessage"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-2"
                            class="mb-6 alert alert-success shadow-lg">
                            <div class="flex items-center w-full">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="stroke-current shrink-0 h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="flex-1">{{ session('status') }}</span>
                                <button @click="showStatusMessage = false"
                                    class="btn btn-sm btn-ghost btn-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endsession

                    {{ $slot }}

                </div>
            </main>
        </div>
    </div>

    <x-chatbot-widget />
</body>

</html>
