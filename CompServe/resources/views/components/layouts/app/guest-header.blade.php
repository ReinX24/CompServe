<header {{-- class="shadow-sm z-40 fixed top-0 left-0 right-0 border-b border-gray-200 bg-base-100"> --}}
    class="navbar bg-primary text-primary-content shadow-sm z-40 fixed top-0 left-0 right-0">
    <div class="flex items-center justify-between h-8 px-4 w-full">
        <div class="flex items-center">
            <a href="/">
                <div class="ml-4 font-semibold text-xl text-primary-content">
                    {{ config('app.name') }}
                </div>
            </a>
        </div>

        <!-- Right side: Theme switcher -->
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
                class="p-2 rounded-full bg-base-200 hover:bg-base-300 transition"
                x-tooltip="'Switch Theme'">
                <!-- Light -->
                <template x-if="theme === 'light'">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6 text-yellow-500">
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
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6 text-blue-500">
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
