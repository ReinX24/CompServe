<!-- Header -->
<header
    class="navbar bg-linear-to-r from-primary via-primary to-secondary text-primary-content shadow-lg backdrop-blur-sm z-40 fixed top-0 left-0 right-0 border-b border-primary-focus/20">
    <div
        class="flex items-center justify-between h-16 px-4 sm:px-6 w-full max-w-screen-2xl mx-auto">
        <!-- Left: Sidebar Toggle + Logo -->
        <div class="flex items-center space-x-3 sm:space-x-4">
            <button @click="toggleSidebar"
                class="p-2.5 rounded-lg hover:bg-primary-focus/50 active:scale-95 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-content/30 group">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 sm:h-6 sm:w-6 transition-transform group-hover:scale-110"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div class="flex items-center gap-2 sm:gap-3">
                <a href="/"
                    class="group">
                    <div class="relative">
                        <img src="{{ asset('images/logo.png') }}"
                            class="h-10 w-10 sm:h-12 sm:w-12 rounded-full shadow-lg ring-2 ring-primary-content/20 group-hover:ring-primary-content/40 transition-all duration-300 group-hover:scale-105">
                        <div
                            class="absolute inset-0 rounded-full bg-primary-content/0 group-hover:bg-primary-content/10 transition-all duration-300">
                        </div>
                    </div>
                </a>
                <a href="/"
                    class="hidden xs:block sm:block group">
                    <div
                        class="font-bold text-base sm:text-lg md:text-xl text-primary-content tracking-tight group-hover:tracking-normal transition-all duration-300">
                        {{ config('app.name') }}
                    </div>
                </a>
            </div>
        </div>

        <!-- Right: Theme Toggle + Profile -->
        <div class="flex items-center space-x-2 sm:space-x-3">
            <!-- Theme Switcher -->
            <div x-data="{
                theme: localStorage.getItem('appearance') || 'system',
                toggleTheme() {
                    if (this.theme === 'light') {
                        this.theme = 'dark';
                        setAppearance('dark');
                    } else if (this.theme === 'dark') {
                        this.theme = 'system';
                        setAppearance('system');
                    } else {
                        this.theme = 'light';
                        setAppearance('light');
                    }
                }
            }"
                x-init="if (theme === 'system') {
                    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                } else {
                    setAppearance(theme);
                }">
                <button @click="toggleTheme"
                    class="p-2.5 rounded-lg bg-primary-content/10 hover:bg-primary-content/20 active:scale-95 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-content/30 group backdrop-blur-sm">
                    <!-- Light -->
                    <template x-if="theme === 'light'">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-300 group-hover:rotate-90 transition-transform duration-500">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 3v2.25m6.364.386-1.591 1.591M21
                                12h-2.25m-.386 6.364-1.591-1.591M12
                                18.75V21m-4.773-4.227-1.591
                                1.591M5.25 12H3m4.227-4.773L5.636
                                5.636M15.75 12a3.75 3.75 0 1
                                1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                        </svg>
                    </template>

                    <!-- Dark -->
                    <template x-if="theme === 'dark'">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-5 h-5 sm:w-6 sm:h-6 text-blue-300 group-hover:scale-110 transition-transform duration-300">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21.752 15.002A9.72 9.72 0 0 1
                                18 15.75c-5.385 0-9.75-4.365-9.75-9.75
                                0-1.33.266-2.597.748-3.752A9.753
                                9.753 0 0 0 3 11.25C3 16.635
                                7.365 21 12.75 21a9.753 9.753 0
                                0 0 9.002-5.998Z" />
                        </svg>
                    </template>

                    <!-- System -->
                    <template x-if="theme === 'system'">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-5 h-5 sm:w-6 sm:h-6 text-green-300 group-hover:scale-110 transition-transform duration-300">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 17.25v1.007a3 3 0 0 1-.879
                                2.122L7.5 21h9l-.621-.621A3 3 0 0
                                1 15 18.257V17.25m6-12V15a2.25
                                2.25 0 0 1-2.25 2.25H5.25A2.25
                                2.25 0 0 1 3 15V5.25m18 0A2.25
                                2.25 0 0 0 18.75 3H5.25A2.25
                                2.25 0 0 0 3 5.25m18 0V12a2.25
                                2.25 0 0 1-2.25 2.25H5.25A2.25
                                2.25 0 0 1 3 12V5.25" />
                        </svg>
                    </template>
                </button>
            </div>

            <!-- Profile Dropdown -->
            <div x-data="{ open: false }"
                class="relative">
                <button @click="open = !open"
                    class="flex items-center gap-2 px-2 sm:px-3 py-2 rounded-lg hover:bg-primary-content/10 active:scale-95 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-content/30 group">
                    <span
                        class="relative flex h-9 w-9 shrink-0 overflow-hidden rounded-lg shadow-md ring-2 ring-primary-content/20 group-hover:ring-primary-content/40 transition-all duration-300">
                        <span
                            class="flex h-full w-full items-center justify-center rounded-lg bg-linear-to-br from-primary-content/80 to-primary-content/60 text-primary font-semibold text-sm group-hover:scale-105 transition-transform duration-300">
                            {{ Auth::user()->initials() }}
                        </span>
                    </span>
                    <span
                        class="ml-1 hidden md:block font-medium text-sm">{{ Auth::user()->name }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 transition-transform duration-300"
                        :class="{ 'rotate-180': open }"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open"
                    @click.away="open = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-[-10px]"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-3 w-52 bg-base-100 text-base-content rounded-xl shadow-2xl py-2 z-50 border border-base-300 backdrop-blur-sm"
                    style="display: none;">
                    <div class="px-4 py-3 border-b border-base-200">
                        <p class="text-sm font-semibold truncate">
                            {{ Auth::user()->name }}</p>
                        <p class="text-xs text-base-content/60 truncate mt-0.5">
                            {{ Auth::user()->email }}</p>
                    </div>
                    <form method="POST"
                        action="{{ route('logout') }}"
                        class="mt-1">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full px-4 py-2.5 text-sm font-medium hover:bg-base-200 active:bg-base-300 transition-colors duration-150 group">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-3 text-base-content/70 group-hover:text-error transition-colors duration-200"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4
                                    4H7m6 4v1a3 3 0 01-3
                                    3H6a3 3 0 01-3-3V7a3 3 0
                                    013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span
                                class="group-hover:text-error transition-colors duration-200">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
