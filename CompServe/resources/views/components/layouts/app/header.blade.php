<!-- Header -->
<header
    class="navbar bg-primary text-primary-content shadow-sm z-40 fixed top-0 left-0 right-0">
    <div class="flex items-center justify-between h-16 px-4 w-full">
        <!-- Left: Sidebar Toggle + Logo -->
        <div class="flex items-center space-x-3">
            <button @click="toggleSidebar"
                class="p-2 rounded-md hover:bg-primary-focus transition focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <a href="/">
                <div class="font-semibold text-xl text-primary-content">
                    {{ config('app.name') }}
                </div>
            </a>
        </div>

        <!-- Right: Theme Toggle + Profile -->
        <div class="flex items-center space-x-4">
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
                    class="p-2 rounded-full bg-base-200 hover:bg-base-300 transition focus:outline-none">
                    <!-- Light -->
                    <template x-if="theme === 'light'">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6 text-yellow-400">
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
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6 text-blue-400">
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
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6 text-green-400">
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
                    class="flex items-center focus:outline-none">
                    <span
                        class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                        <span
                            class="flex h-full w-full items-center justify-center rounded-lg bg-base-200 text-primary">
                            {{ Auth::user()->initials() }}
                        </span>
                    </span>
                    <span
                        class="ml-2 hidden md:block">{{ Auth::user()->name }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 ml-1"
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
                    x-transition
                    class="absolute right-0 mt-2 w-48 bg-base-100 text-base-content rounded-md shadow-lg py-1 z-50 border border-base-200">
                    <form method="POST"
                        action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full px-4 py-2 text-sm hover:bg-base-200 transition">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-2"
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
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
