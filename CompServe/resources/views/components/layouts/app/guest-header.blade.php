<header
    class="navbar bg-linear-to-r from-primary via-primary to-secondary text-primary-content shadow-lg backdrop-blur-sm z-40 fixed top-0 left-0 right-0 border-b border-primary-focus/20">
    <div
        class="flex items-center justify-between h-16 px-4 sm:px-6 w-full max-w-screen-2xl mx-auto">
        <!-- Left: Logo + App Name -->
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
                class="group">
                <div
                    class="font-bold text-base sm:text-lg md:text-xl text-primary-content tracking-tight group-hover:tracking-normal transition-all duration-300">
                    {{ config('app.name') }}
                </div>
            </a>
        </div>

        <!-- Right: Theme Switcher -->
        <div x-data="{
            theme: localStorage.getItem('theme') || 'light',
            themes: ['light', 'dark'],
            toggleTheme() {
                let index = this.themes.indexOf(this.theme);
                this.theme = this.themes[(index + 1) % this.themes.length];
                setAppearance(this.theme);
            }
        }"
            x-init="setAppearance(theme)">
            <button @click="toggleTheme"
                class="p-2.5 rounded-lg bg-black/20 hover:bg-black/30 active:scale-95 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white/30 group backdrop-blur-sm"
                x-tooltip="'Switch Theme'">
                <!-- Light -->
                <template x-if="theme === 'light'">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="w-5 h-5 sm:w-6 sm:h-6 text-white group-hover:rotate-90 transition-transform duration-500 drop-shadow-lg">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386
                            6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591
                            1.591M5.25 12H3m4.227-4.773L5.636
                            5.636M15.75 12a3.75 3.75 0
                            1 1-7.5 0 3.75 3.75 0 0 1
                            7.5 0Z" />
                    </svg>
                </template>
                <!-- Dark -->
                <template x-if="theme === 'dark'">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="w-5 h-5 sm:w-6 sm:h-6 text-white group-hover:scale-110 transition-transform duration-300 drop-shadow-lg">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21.752 15.002A9.72 9.72 0
                            0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75
                            0-1.33.266-2.597.748-3.752A9.753
                            9.753 0 0 0 3 11.25C3 16.635
                            7.365 21 12.75 21a9.753 9.753
                            0 0 0 9.002-5.998Z" />
                    </svg>
                </template>
            </button>
        </div>
    </div>
</header>
